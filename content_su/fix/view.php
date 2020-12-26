<?php
namespace content_su\fix;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		self::file_croper();

		// self::setting_news_fix();


	}

	private static $result =
	[
		'count'                   => 0,
		'counImage'               => 0,
		'CropedFile'              => 0,
		'FileCropExists'          => 0,
		'NeedToCrop'              => 0,
		'RemoveVeryOldCropedFile' => 0,
		'RemoveOldCrop'           => 0,

	];


	private static function file_croper()
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

					self::$result['count']++;

					$path_info = pathinfo($file);

					self::fix_file($path_info, $file);

				}
			}
		}


		$jibres_file = glob(YARD. 'talambar_dl/*');

		foreach ($jibres_file as $folders)
		{


			$files = glob($folders. '/*');

			foreach ($files as $file)
			{

				self::$result['count']++;

				$path_info = pathinfo($file);

				self::fix_file($path_info, $file);
			}

		}

		var_dump(self::$result);

		exit();
	}


	private static function fix_file($path_info, $file)
	{
		if(isset($path_info['extension']) &&  in_array($path_info['extension'], ['jpg','jpeg','png','gif', 'webp']))
		{
			self::$result['counImage']++;

			if(self::remove_old_file($file))
			{
				self::$result['RemoveVeryOldCropedFile']++;
				return;
			}


			if(self::remove_bad_crop($file, $path_info['extension']))
			{
				self::$result['RemoveOldCrop']++;
				return;
			}


			if(self::the_croped_file($file))
			{
				self::$result['CropedFile']++;
				return;
			}


			if(self::is_croped($file, $path_info['extension']))
			{
				self::$result['FileCropExists']++;
				return;
			}

			\dash\utility\image::responsive_image($file, $path_info['extension']);

			self::$result['NeedToCrop']++;

			var_dump($file);

		}
	}

	private static function remove_bad_crop($_path, $_ext)
	{
		if(isset($path_info['extension']) &&  in_array($path_info['extension'], ['jpg','jpeg','png','gif']))
		{

			if(strpos($_path, '-w120.') !== false)
			{
				unlink($_path);
				return true;
			}


			if(strpos($_path, '-w220.') !== false)
			{
				unlink($_path);
				return true;
			}


			if(strpos($_path, '-w300.') !== false)
			{
				unlink($_path);
				return true;
			}


			if(strpos($_path, '-w460.') !== false)
			{
				unlink($_path);
				return true;
			}

			if(strpos($_path, '-w780.') !== false)
			{
				unlink($_path);
				return true;
			}

			if(strpos($_path, '-w1100.') !== false)
			{
				unlink($_path);
				return true;
			}

		}




		return false;

	}


	private static function remove_old_file($_path)
	{
		if(strpos($_path, '-normal-') !== false)
		{
			unlink($_path);
			return true;
		}


		if(strpos($_path, '-thumb-') !== false)
		{
			unlink($_path);
			return true;
		}


		if(strpos($_path, '-large-') !== false)
		{
			unlink($_path);
			return true;
		}

		if(strpos($_path, '-normal.') !== false)
		{
			unlink($_path);
			return true;
		}


		if(strpos($_path, '-thumb.') !== false)
		{
			unlink($_path);
			return true;
		}


		if(strpos($_path, '-large.') !== false)
		{
			unlink($_path);
			return true;
		}



		return false;

	}

	private static function is_croped($_path, $_ext)
	{
		$a = ['-w120.', '-w220.', '-w300.', '-w460.', '-w780.', '-w1100.',];

		$new_path = str_replace('.'. $_ext, '', $_path);

		foreach ($a as $key => $value)
		{
			$new_file_check = $new_path. $value. 'webp';
			if(is_file($new_file_check))
			{
				return true;
			}
		}

		return false;
	}

	private static function the_croped_file($_path)
	{
		$a = ['-w120.', '-w220.', '-w300.', '-w460.', '-w780.', '-w1100.',];
		foreach ($a as $key => $value)
		{
			if(strpos($_path, $value) !== false)
			{
				return true;
			}
		}

		return false;
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