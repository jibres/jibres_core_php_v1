<?php
namespace content_su\fix;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());


	}



	private static function fix_ratio_file()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		$file_error = [];
		$duplicate = 0;
		$run = 0;

		foreach ($list as $key => $value)
		{
			$query = "	SELECT * FROM files WHERE files.ext IN ('jpg','jpeg','png','gif', 'webp') ";
			$store_id = $value['id'];
			$dbname = \dash\engine\store::make_database_name($store_id);
			$resutl = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);
			if($resutl)
			{

				foreach ($resutl as $one_file)
				{
					if(isset($one_file['path']))
					{
						if(a($one_file, 'height') || a($one_file, 'width'))
						{
							$duplicate++;
							continue;
						}


						$addr = YARD . 'talambar_cloud/';
						$addr .=\dash\store_coding::encode_raw();
						$addr .= $one_file['path'];

						if(!is_file($addr))
						{
							$file_error[] = $addr;
							continue;
						}

						$update = [];

						$ratio_detail = \dash\utility\image::get_ratio($addr, true);

						if(isset($ratio_detail['height']))
						{
							$update['height'] = $ratio_detail['height'];
						}

						if(isset($ratio_detail['width']))
						{
							$update['width'] = $ratio_detail['width'];
						}

						if(isset($ratio_detail['ratio']))
						{
							$update['ratio'] = $ratio_detail['ratio'];
						}

						if(!empty($update))
						{
							$set = \dash\db\config::make_set($update);

							$load_usage = \dash\db::query("UPDATE files SET $set WHERE files.id = '$one_file[id]' LIMIT 1 ", $value['fuel'], ['database' => $dbname]);
							$run++;
						}
					}
				}
			}
		}
		var_dump("run", $run);
		var_dump("duplicate", $duplicate);
		var_dump("file not found", $file_error);
		exit();
	}
}
?>