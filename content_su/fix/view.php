<?php
namespace content_su\fix;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());


		// self::check_file();

	}

	private static $result = [];

	private static function check_file()
	{
		$store_folders = glob(YARD. 'talambar_cloud/*');

		foreach ($store_folders as $store_folder)
		{

			$folders = glob($store_folder. '/*');

			if(!$folders)
			{
				continue;
			}

			foreach ($folders as $date_folder)
			{

				$date = glob($date_folder. '/*');

				if(!$date)
				{
					continue;
				}

				foreach ($date as $file)
				{


					$path_info = pathinfo($file);

					self::check_file_builded_webp($path_info, $file);

				}
			}
		}


		$jibres_file = glob(YARD. 'talambar_dl/*');

		foreach ($jibres_file as $folders)
		{


			$files = glob($folders. '/*');

			foreach ($files as $file)
			{

				$path_info = pathinfo($file);

				self::check_file_builded_webp($path_info, $file);
			}

		}

		var_dump(self::$result);
		exit();

	}


	private static function check_file_builded_webp($path_info, $file)
	{
		if(in_array($path_info['extension'], ['jpg', 'png', 'giff']))
		{
			self::is_croped($file, $path_info['extension']);
		}
	}



	private static function is_croped($_path, $_ext)
	{
		$a = ['-w120.', '-w220.', '-w300.', '-w460.', '-w780.', '-w1100.',];

		$new_path = str_replace('.'. $_ext, '', $_path);

		$drop = false;
		foreach ($a as $key => $value)
		{
			$new_file_check = $new_path. $value. 'webp';

			if(!is_file($new_file_check))
			{
				$drop = true;
				self::$result[] = $new_file_check;
			}
		}

		if($drop)
		{
			foreach ($a as $key => $value)
			{
				$new_file_check = $new_path. $value. 'webp';

				if(is_file($new_file_check))
				{
					unlink($new_file_check);
				}
			}

			\dash\utility\image::responsive_image($_path, $_ext);


		}

	}


	private static function setting_news_fix()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		foreach ($list as $key => $value)
		{
			$query = "SELECT * FROM setting WHERE setting.key LIKE 'body_line_news' ";
			$dbname = \dash\engine\store::make_database_name($value['id']);
			$resutl = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);
			if($resutl)
			{
			var_dump($value);
				var_dump($resutl);
			}
		}
		var_dump($list
		);exit();
	}
}
?>