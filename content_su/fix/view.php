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


	private static function file_croper()
	{
		$store_folders = glob(YARD. 'talambar_cloud/*');
		if(!$store_folders)
		{
			die('No folders');
			return;
		}

		$result =
		[
			'count'               => 0,
			'counImage'           => 0,
			'CropedFile'          => 0,
			'FileCropExists'            => 0,
			'NeedToCrop'          => 0,
			'CountForEeach'       => 0,
			'RemoveOldCropedFile' => 0,

		];

		foreach ($store_folders as $store_folder)
		{
			$result['CountForEeach']++;

			$folders = glob($store_folder. '/*');

			if(!$folders)
			{
				continue;
			}

			foreach ($folders as $date_folder)
			{
				$result['CountForEeach']++;

				$date = glob($date_folder. '/*');

				if(!$date)
				{
					continue;
				}

				foreach ($date as $file)
				{
					$result['CountForEeach']++;

					$result['count']++;

					$path_info = pathinfo($file);

					if(isset($path_info['extension']) &&  in_array($path_info['extension'], ['jpg','jpeg','png','gif']))
					{
						$result['counImage']++;



						if(self::remove_old_file($file))
						{
							$result['RemoveOldCropedFile']++;
							continue;
						}


						if(self::the_croped_file($file))
						{
							$result['CropedFile']++;
							continue;
						}


						if(self::is_croped($file, $path_info['extension']))
						{
							$result['FileCropExists']++;
							continue;
						}

						\dash\upload\crop::pic($file, $path_info['extension']);

						$result['NeedToCrop']++;


						// var_dump($file);
					}
					// var_dump($path_info);
					// var_dump($file);
				}
			}


		}


		$jibres_file = glob(YARD. 'talambar_dl/*');

		foreach ($jibres_file as $folders)
		{

			$result['CountForEeach']++;

			$files = glob($folders. '/*');

			// var_dump($files);exit();

			foreach ($files as $file)
			{
				$result['CountForEeach']++;

				$result['count']++;

				$path_info = pathinfo($file);

				if(isset($path_info['extension']) &&  in_array($path_info['extension'], ['jpg','jpeg','png','gif']))
				{
					$result['counImage']++;

					if(self::remove_old_file($file))
					{
						$result['RemoveOldCropedFile']++;
						continue;
					}


					if(self::the_croped_file($file))
					{
						$result['CropedFile']++;
						continue;
					}


					if(self::is_croped($file, $path_info['extension']))
					{
						$result['FileCropExists']++;
						continue;
					}

					\dash\upload\crop::pic($file, $path_info['extension']);

					$result['NeedToCrop']++;


				}
			}

		}

		var_dump($result);

		exit();
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
			$new_file_check = $new_path. $value. $_ext;
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