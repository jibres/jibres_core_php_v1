<?php
namespace content_su\fix;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		self::image_ratio();

	}



	private static function image_ratio()
	{
		set_time_limit(0);


		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		$file_error = [];
		$duplicate = 0;
		$run = 0;

		\dash\scp::uploader_connection();

		foreach ($list as $key => $value)
		{
			$query = "	SELECT * FROM files where files.type = 'image' and files.ratio is null ";
			$store_id = $value['id'];
			$dbname = \dash\engine\store::make_database_name($store_id);
			$resutl = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);

			if($resutl)
			{

				foreach ($resutl as $one_file)
				{
					$dir = 'talambar_cloud/'.$one_file['path'];

					$tmp_dir = '/tmp/myTempImageToGetDetail.reza.image';

					$resv = \dash\scp::recv($dir, $tmp_dir);
					if($resv)
					{
						$ratio_detail = \dash\utility\image::get_ratio($tmp_dir, true);

						$update_file = [];

						if(isset($ratio_detail['height']))
						{
							$update_file['height'] = $ratio_detail['height'];
						}

						if(isset($ratio_detail['width']))
						{
							$update_file['width'] = $ratio_detail['width'];
						}

						if(isset($ratio_detail['ratio']))
						{
							$update_file['ratio'] = $ratio_detail['ratio'];
						}

						if(!empty($update_file))
						{
							$set = \dash\db\config::make_set($update_file);
							$query = " UPDATE  files SET $set WHERE files.id = $one_file[id] LIMIT 1 ";
							\dash\db::query($query, $value['fuel'], ['database' => $dbname]);
						}
					}
				}
			}

			\dash\db\mysql\tools\connection::close();
		}

		var_dump('ok');
		exit();
	}



	private static function fix_store()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		$file_error = [];
		$duplicate = 0;
		$run = 0;

		foreach ($list as $key => $value)
		{
			$query = "	SELECT * FROM products where products.company_id is not null ";
			$store_id = $value['id'];
			$dbname = \dash\engine\store::make_database_name($store_id);
			$resutl = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);

			if($resutl)
			{
				foreach ($resutl as $one_product)
				{
					$query = "	SELECT *  FROM productcompany where productcompany.id  = '$one_product[company_id]' LIMIT 1 ";
					$company_detail = \dash\db::get($query, null, true, $value['fuel'], ['database' => $dbname]);

					if(isset($company_detail['title']))
					{
						$query = "	SELECT *  FROM producttag where producttag.title  = '$company_detail[title]' LIMIT 1 ";
						$tag_detail = \dash\db::get($query, null, true, $value['fuel'], ['database' => $dbname]);

						if(isset($tag_detail['id']))
						{
							$tag_id = $tag_detail['id'];
						}
						else
						{
							$date = date("Y-m-d H:i:s");
							$slug = \dash\validate::slug($company_detail['title']);
							$query = " INSERT INTO producttag SET producttag.title = '$company_detail[title]', producttag.slug = '$slug', producttag.status = 'enable', producttag.datecreated = '$date' ";
							\dash\db::query($query, $value['fuel'], ['database' => $dbname]);
							$tag_id = \dash\db::insert_id();
						}


						if($tag_id)
						{
							$query = "	SELECT *  FROM producttagusage where producttagusage.producttag_id  = '$tag_id' AND producttagusage.product_id = '$one_product[id]' LIMIT 1 ";
							$tag_usage_detail = \dash\db::get($query, null, true, $value['fuel'], ['database' => $dbname]);

							if(isset($tag_usage_detail['product_id']))
							{
								// this product have this tag
							}
							else
							{
								$query = " INSERT INTO producttagusage SET producttagusage.producttag_id = '$tag_id', producttagusage.product_id = '$one_product[id]' ";
								\dash\db::query($query, $value['fuel'], ['database' => $dbname]);
							}
						}
					}
				}
			}

			\dash\db\mysql\tools\connection::close();
		}

		var_dump('ok');
		exit();
	}
}
?>