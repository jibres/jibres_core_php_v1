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


	private static function fix_store()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		$file_error = [];
		$duplicate = 0;
		$run = 0;

		set_time_limit(0);

		foreach ($list as $key => $value)
		{
			$query = "	SELECT * FROM producttag where producttag.id in (select producttagusage.producttag_id from producttagusage) ";
			$store_id = $value['id'];
			$dbname = \dash\engine\store::make_database_name($store_id);
			$resutl = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);

			if($resutl)
			{
				foreach ($resutl as $one_tag)
				{

					$query = "	SELECT *  FROM productcategory where productcategory.title  = '$one_tag[title]' LIMIT 1 ";
					$category_detail = \dash\db::get($query, null, true, $value['fuel'], ['database' => $dbname]);

					if(isset($category_detail['id']))
					{
						$tag_id = $category_detail['id'];
					}
					else
					{
						$date = $one_tag['datecreated'];
						$slug = \dash\validate::slug($one_tag['title']);
						$query = " INSERT INTO productcategory SET productcategory.title = '$one_tag[title]', productcategory.slug = '$slug', productcategory.status = 'enable', productcategory.datecreated = '$date' ";
						\dash\db::query($query, $value['fuel'], ['database' => $dbname]);
						$tag_id = \dash\db::insert_id();
					}

					if($tag_id)
					{
						$old_tag_id = $one_tag['id'];
						$query = "	SELECT *  FROM producttagusage where producttagusage.producttag_id  = '$old_tag_id' ";
						$all_old_usage_tag = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);

						foreach ($all_old_usage_tag as $old_usage_tag)
						{
							$query = "	SELECT *  FROM productcategoryusage where productcategoryusage.productcategory_id  = '$tag_id' AND productcategoryusage.product_id = '$old_usage_tag[product_id]' LIMIT 1 ";
							$tag_usage_detail = \dash\db::get($query, null, true, $value['fuel'], ['database' => $dbname]);

							if(isset($tag_usage_detail['product_id']))
							{
								// this product have this tag
							}
							else
							{
								$query = " INSERT INTO productcategoryusage SET productcategoryusage.productcategory_id = '$tag_id', productcategoryusage.product_id = '$old_usage_tag[product_id]' ";
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