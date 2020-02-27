<?php
namespace dash\engine\cronjob;

class options
{
	public static $cronjob_folder = 'includes/cronjob';


	private static function cronjob_folder($_file_name)
	{
		$addr = root. self::$cronjob_folder;
		if(!is_dir($addr))
		{
			\dash\file::makeDir($addr);
		}
		$addr .= '/'. $_file_name;
		return $addr;
	}


	public static function current_cronjob_path()
	{
		return '* * * * * php '. __DIR__ . '/cronjob.php';
	}


	public static function unixcrontab()
	{
		return shell_exec('crontab -l');
	}


	private static function set_cronjob($_active)
	{
		$output          = shell_exec('crontab -l');
		$new_crontab_txt = $output;
		$set_active      = false;

		if($_active)
		{
			if(self::status())
			{
				// needless to active again
				return true;
			}

			$set_active = true;

			$new_crontab_txt .= self::current_cronjob_path(). PHP_EOL;
		}
		else
		{
			if(!self::status())
			{
				// needless to deactive again
				return true;
			}

			$new_crontab_txt = str_replace(self::current_cronjob_path(). PHP_EOL, '', $new_crontab_txt);
		}

		\dash\file::write(__DIR__.'/crontab.txt', $new_crontab_txt);
		exec('crontab '. __DIR__.'/crontab.txt', $result, $return_val);

		if($return_val === 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public static function active()
	{
		return self::set_cronjob(true);
	}


	public static function deactive()
	{
		return self::set_cronjob(false);
	}


	public static function status()
	{
		exec('crontab -l', $list, $return_val);
		if($return_val === 0 && is_array($list))
		{
			if(in_array(self::current_cronjob_path(), $list))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}



}
?>