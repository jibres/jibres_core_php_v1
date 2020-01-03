<?php
namespace dash\engine\backup;

class database
{

	/**
	 * Save backup setting from su
	 */
	public static function backup_schedule()
	{

		$array =
		[
			'auto_backup' => \dash\request::post('auto_backup') === 'on' ? true : false,
			'every'       => \dash\request::post('every'),
			'time'        => \dash\request::post('time'),
			'life_time'   => \dash\request::post('life_time'),
			'update_time' => date("Y-m-d H:i:s"),
			// data base name is here
		];

		$array = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

		$url = self::schedule_addr();
		\dash\file::write($url, $array);

		\dash\notif::ok(T_("Auto backup schedule saved"));
	}


	/**
	 * Run from cronjob
	 *
	 */
	public static function run()
	{
		if(self::schedule_detail())
		{
			// self::clean();
			self::run_backup();
		}
	}



	private static function backup_folder_path()
	{
		$url    = database . 'backup/file';

		if(!\dash\file::exists($url))
		{
			\dash\file::makeDir($url, null, true);
		}

		return $url;
	}



	private static function schedule_addr()
	{
		$url    = database . 'backup';

		if(!\dash\file::exists($url))
		{
			\dash\file::makeDir($url, null, true);
		}

		$url .= '/schedule.json';
		return $url;
	}


	private static function schedule_detail()
	{
		$get = \dash\file::read(self::schedule_addr());
		if(is_string($get))
		{
			$get = json_decode($get, true);
		}

		if(!is_array($get))
		{
			$get = [];
		}

		return $get;
	}



	private static function run_backup()
	{
		$schedule = self::schedule_detail();
		if(!array_key_exists('auto_backup', $schedule) || !array_key_exists('every', $schedule) || !array_key_exists('time', $schedule))
		{
			return;
		}

		if(!$schedule['auto_backup'] || !$schedule['every'] || !$schedule['time'])
		{
			return;
		}

		// in every hour run every hour
		// in other mode run on special hour
		if($schedule['every'] != 'hour' && date("H") !== $schedule['time'])
		{
			return;
		}

		$left_time = self::get_left_time($schedule['every'], $schedule['time']);

		if($left_time === false)
		{
			return;
		}

		$all_store = \lib\db\store\get::all_store_fuel_detail();

		$folder       = date('Y_m_d'). '/'. date("H");
		$backup_dir = self::backup_folder_path() . '/'. $folder;

		if(is_dir($backup_dir))
		{
			return;
		}

		\dash\file::makeDir($backup_dir, null, true);

		\dash\file::delete(__DIR__.'/temp.me.exec');
		foreach ($all_store as $key => $value)
		{
			$fuel      = \dash\engine\fuel::get($value['fuel']);
			$db_name   = \dash\engine\store::make_database_name($value['id']);
			$subdomain = $value['subdomain'];
			self::backup_dump_exec($backup_dir, $fuel, $db_name, $subdomain, $value);
		}

		$exec = exec('sh '. __DIR__.'/temp.me.exec', $output, $return_var);


	}


	private static function backup_dump_exec($_dir, $_fuel, $_database_name, $_subdomain, $_meta)
	{

		$db_charset = 'utf8mb4';

		$date       = date('Y-m-d_H-i-s');
		$dest_file  = $_database_name. '_'. $date. '.sql.bz2';


		$cmd  = "mysqldump --single-transaction --add-drop-table";
		$cmd .= " --skip-lock-tables ";
		$cmd .= " --host='$_fuel[host]' --set-charset='$db_charset'";
		$cmd .= " --user='$_fuel[user]'";
		$cmd .= " --password='$_fuel[pass]' '$_database_name'";
		$cmd .= " | bzip2 -c > $_dir/$dest_file 2>&1 &";

		// to import this file
		// bunzip2 < filename.sql.bz2 | mysql -u root -p $project_name
		//
		\dash\file::append(__DIR__.'/temp.me.exec', $cmd. "\n");

	}


	private static function clean()
	{
		$schedule = self::schedule_detail();
		if(!$schedule)
		{
			return;
		}

		if(!array_key_exists('life_time', $schedule))
		{
			return;
		}

		$left_time = self::get_left_time($schedule['life_time']);
		if($left_time === false)
		{
			return;
		}

		$url         = preg_replace("/schedule$/", 'files/', self::backup_folder_path());
		$files       = glob($url . "*.*");
		$must_remove = [];

		foreach ($files as $key => $value)
		{
			if(time() - filemtime($value) > $left_time)
			{
				array_push($must_remove, $value);
			}
		}
		if($must_remove)
		{
			$cmd = "rm ". implode(' ', $must_remove);
			$result     = exec($cmd, $output, $return_var);
			if($return_var ===  0 )
			{
				$log_txt = '---------------'. "\n";
				$log_txt .= 'Autoremove at: ';
				$log_txt .= date("Y-m-d_H-i-s");
				$log_txt .= ' - files: '. "\n" . implode("\n", $must_remove);
				$log_txt .= "\n";
				self::save_log(self::backup_folder_path(), $log_txt);
			}
		}
	}


	private static function get_left_time($_time, $_time2 = null)
	{
		$left_time = 1;

		switch ($_time)
		{
			case 'year2':
				$left_time *= 60 * 60 * 24 * 365 * 2;
				break;

			case 'year':
				$left_time *= 60 * 60 * 24 * 365;
				break;

			case 'month6':
				$left_time *= 60 * 60 * 24 * 30 * 6;
				break;

			case 'month3':
				$left_time *= 60 * 60 * 24 * 30 * 3;
				break;

			case 'month2':
				$left_time *= 60 * 60 * 24 * 30 * 2;
				break;

			case 'month':
				$left_time *= 60 * 60 * 24 * 30;
				break;

			case 'week':
				$left_time *= 60 * 60 * 24 * 7;
				break;

			case 'week2':
				$left_time *= 60 * 60 * 24 * 7 * 2;
				break;

			case 'day':
				$left_time *= 60 * 60 * 24;
				break;

			case 'day3':
				$left_time *= 60 * 60 * 24 * 3;
				break;

			case 'day5':
				$left_time *= 60 * 60 * 24 * 5;
				break;

			case 'hour':
				$left_time *= 60 * 60 * intval($_time2);
				if($left_time === 0)
				{
					$left_time = 60 * 60 * 1;
				}
				break;

			default:
				return false;
				break;
		}
		return $left_time;
	}


	private static function save_log($_text)
	{
		$_text    = "--------------- \n $_text \n";
		$log_file = preg_replace("/schedule$/", 'log', self::backup_folder_path());
		file_put_contents( $log_file, $_text, FILE_APPEND );
	}
}
?>