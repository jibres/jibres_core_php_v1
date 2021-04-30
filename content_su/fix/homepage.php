<?php
namespace content_su\fix;


class homepage
{
	public static function convert()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting    = [];
		$file_error = [];
		$duplicate  = 0;
		$run        = 0;

		foreach ($list as $key => $store)
		{

			$store_id = $store['id'];

			$dbname = \dash\engine\store::make_database_name($store_id);


			$query = "SELECT * FROM setting WHERE setting.platform = 'website' AND setting.cat = 'body' AND setting.key = 'sort_line' LIMIT 1";

			$sort_line = \dash\db::get($query, null, true, $store['fuel'], ['database' => $dbname]);

			$sort = null;

			if(isset($sort_line['value']))
			{
				$sort = $sort_line['value'];
				$sort = json_decode($sort, true);
				if(!is_array($sort))
				{
					$sort = [];
				}

				if($sort)
				{
					$sort = " ORDER BY  FIELD(setting.id, " . implode(',', $sort).") ";
				}
				else
				{
					$sort = null;
				}

			}

			$query = "SELECT * FROM setting WHERE setting.platform = 'website' $sort";

			$all_website_setting = \dash\db::get($query, null, false, $store['fuel'], ['database' => $dbname]);


			$store_website           = [];
			$store_website['header'] = [];
			$store_website['body']   = [];
			$store_website['footer'] = [];

			foreach ($all_website_setting as $key => $value)
			{
				if(a($value, 'cat') === 'status' && a($value, 'key') === 'active')
				{
					$store_website['status'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'homepage' && substr(a($value, 'key'), 0, 10)  === 'body_line_')
				{
					if(substr(a($value, 'value'), 0, 1) === '{' || substr(a($value, 'value'), 0, 1) === '[')
					{
						$store_website['body'][] = json_decode(a($value, 'value'), true);
					}
					else
					{
						$store_website['body'][] = a($value, 'value');
					}
					continue;
				}

				if(a($value, 'cat') === 'body' && a($value, 'key')  === 'sort_line')
				{
					continue;
				}

				if(a($value, 'cat') === 'header' && a($value, 'key') === 'active')
				{
					$store_website['header']['active'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'footer' && a($value, 'key') === 'active')
				{
					$store_website['footer']['active'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'menu' && substr(a($value, 'key'), 0, 5) === 'menu_')
				{
					continue;
				}

				if(a($value, 'cat') === 'header_customized' && a($value, 'key') === 'header_menu_1')
				{
					$store_website['header']['header_menu_1'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'header_customized' && a($value, 'key') === 'header_menu_2')
				{
					$store_website['header']['header_menu_2'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'header_customized' && a($value, 'key') === 'header_logo')
				{
					$store_website['header']['header_logo'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'footer' && a($value, 'key') === 'maintext')
				{
					$store_website['footer']['maintext'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'header' && a($value, 'key') === 'topline')
				{
					$store_website['header']['topline'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'footer_customized' && a($value, 'key') === 'footer_menu_1')
				{
					$store_website['footer']['footer_menu_1'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'footer_customized' && a($value, 'key') === 'footer_menu_2')
				{
					$store_website['footer']['footer_menu_2'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'footer_customized' && a($value, 'key') === 'footer_menu_3')
				{
					$store_website['footer']['footer_menu_3'] = a($value, 'value');
					continue;
				}

				if(a($value, 'cat') === 'footer_customized' && a($value, 'key') === 'footer_menu_4')
				{
					$store_website['footer']['footer_menu_4'] = a($value, 'value');
					continue;
				}



				var_dump($store_website);
				var_dump($value);exit();
			}

			self::create_business_homepage($store, $store_website);

			\dash\db\mysql\tools\connection::close();

			continue;



			var_dump($store_website);exit();


		$query =
		"
			SELECT
				*
			FROM
				setting
			WHERE
				setting.platform = 'website'
			$sort

			";


			$query = "SELECT * FROM products where products.company_id is not null ";





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



	private static function create_business_homepage($store, $store_website)
	{
		if(!a($store_website, 'status'))
		{
			var_dump($store);
			var_dump($store_website);
			exit();
		}

		$fuel     = $store['fuel'];
		$store_id = $store['id'];
		$dbname   = \dash\engine\store::make_database_name($store_id);

		$last_sort = 0;

		$post_title = T_("Default homepage");


		$date       = date("Y-m-d H:i:s");

		$check_duplicate_query = "SELECT * FROM posts WHERE posts.title = '$post_title' AND posts.type = 'pagebuilder' and  posts.status = 'publish' LIMIT 1 ";

		$check_duplicate = \dash\db::get($check_duplicate_query, null, true, $fuel, ['database' => $dbname]);

		if(isset($check_duplicate['id']))
		{
			$post_id = $check_duplicate['id'];
		}
		else
		{

			$query = " INSERT INTO posts SET posts.title = '$post_title',  posts.type = 'pagebuilder',  posts.status = 'publish', posts.datecreated = '$date', posts.user_id = 1 ";

			$add_new_post = \dash\db::query($query, $fuel, ['database' => $dbname]);

			$post_id = \dash\db::insert_id();
		}

		if(isset($store_website['header']['active']) && count($store_website['header']) === 1)
		{
			$check_duplicate_query = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = '$post_id' AND pagebuilder.mode = 'header' LIMIT 1 ";

			$check_duplicate = \dash\db::get($check_duplicate_query, null, true, $fuel, ['database' => $dbname]);

			if(isset($check_duplicate['id']))
			{
				$header_id = $check_duplicate['id'];
			}
			else
			{
				if($store_website['header']['active'] === 'header_100')
				{
					$header_title = T_("Header #100");
				}
				else
				{
					var_dump($store_website);exit();
				}

				$last_sort = $last_sort + 10;

				$query =
				"
					INSERT INTO pagebuilder SET
						pagebuilder.title = '$header_title',
						pagebuilder.platform = 'website',
						pagebuilder.mode = 'header',
						pagebuilder.related = 'posts',
						pagebuilder.type = 'h100',
						pagebuilder.sort = '$last_sort',
						pagebuilder.status = 'draft',
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_header = \dash\db::query($query, $fuel, ['database' => $dbname]);

				$header_id = \dash\db::insert_id();
			}
				var_dump($header_id);

		}
		else
		{
			var_dump('specail headeer');
			var_dump($store_website);
		}


		var_dump($post_id);exit();


	}
}