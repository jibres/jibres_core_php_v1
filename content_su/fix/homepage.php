<?php
namespace content_su\fix;


class homepage
{
	public static function convert()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		foreach ($list as $key => $store)
		{

			$store_id = $store['id'];

			$dbname = \dash\engine\store::make_database_name($store_id);

			$query = "SELECT * FROM setting WHERE setting.platform = 'website' AND setting.cat = 'status' AND setting.key = 'active' LIMIT 1";

			$active = \dash\db::get($query, null, true, $store['fuel'], ['database' => $dbname]);

			if(isset($active['value']))
			{
				if($active['value'] === 'visitcard' || $active['value'] === 'comingsoon')
				{
					$check_duplicate_query =
					"
						SELECT * FROM posts WHERE  posts.type = 'pagebuilder' and  posts.status = 'publish' ORDER BY posts.id ASC LIMIT 1
					";

					$check_duplicate = \dash\db::get($check_duplicate_query, null, true, $store['fuel'], ['database' => $dbname]);


					if(isset($check_duplicate['id']))
					{
						$post_id = $check_duplicate['id'];

						$query = " UPDATE posts SET posts.meta = '{\"template\": \"$active[value]\"}' WHERE posts.id = $post_id LIMIT 1 ";

						\dash\db::query($query, $store['fuel'], ['database' => $dbname]);
						var_dump($store);
					}
					else
					{
						var_dump('posts_ID NOT FOUND');
					}


				}
			}

			\dash\db\mysql\tools\connection::close();

		}

		var_dump('ok');
		exit();
	}



	private static function create_business_homepage___($store, $store_website)
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

		// set as homepage
		$query                   = "SELECT * FROM setting WHERE setting.cat = 'store_setting' AND setting.key = 'homepage_builder_post_id'  LIMIT 1";
		$check_added_to_homepage = \dash\db::get($query, null, true, $fuel, ['database' => $dbname]);

		if(!isset($check_added_to_homepage['id']))
		{
			$query = "INSERT INTO  setting SET setting.cat = 'store_setting' , setting.key = 'homepage_builder_post_id', setting.value = '$post_id'";
			\dash\db::query($query, $fuel, ['database' => $dbname]);
		}

		// ------------------------------------------------------ HEADER  ------------------------------------------------------------------------------------------- //

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
					$header_code = 'h100';
				}
				elseif($store_website['header']['active'] === 'header_300')
				{
					$header_title = T_("Header #300");
					$header_code = 'h300';
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
						pagebuilder.type = '$header_code',
						pagebuilder.sort = '$last_sort',
						pagebuilder.status = 'draft',
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_header = \dash\db::query($query, $fuel, ['database' => $dbname]);

				$header_id = \dash\db::insert_id();
			}

		}
		else
		{
			if(a($store_website, 'header', 'active') === 'header_300')
			{
				$header_title = T_("Header #300");
				$header_code = 'h300';

				$detail = [];

				if(isset($store_website['header']['header_menu_1']))
				{
					$detail['header_menu_1'] = $store_website['header']['header_menu_1'];
				}

				if(isset($store_website['header']['header_menu_2']))
				{
					$detail['header_menu_2'] = $store_website['header']['header_menu_2'];
				}

				if(isset($store_website['header']['header_logo']))
				{
					$detail['logo'] = $store_website['header']['header_logo'];
				}

				if(isset($store_website['header']['topline']))
				{
					$detail['announcement'] = $store_website['header']['topline'];
				}


				$last_sort = $last_sort + 10;

				$detail = json_encode($detail, JSON_UNESCAPED_UNICODE);

				$query =
				"
					INSERT INTO pagebuilder SET
						pagebuilder.title = '$header_title',
						pagebuilder.platform = 'website',
						pagebuilder.mode = 'header',
						pagebuilder.related = 'posts',
						pagebuilder.type = '$header_code',
						pagebuilder.sort = '$last_sort',
						pagebuilder.detail = '$detail',
						pagebuilder.status = 'draft',
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_header = \dash\db::query($query, $fuel, ['database' => $dbname]);




			}
			elseif(a($store_website, 'header', 'active') === 'header_100')
			{
				$header_title = T_("Header #100");
				$header_code = 'h100';

				$detail = [];

				if(isset($store_website['header']['header_menu_1']))
				{
					$detail['header_menu_1'] = $store_website['header']['header_menu_1'];
				}

				if(isset($store_website['header']['header_menu_2']))
				{
					$detail['header_menu_2'] = $store_website['header']['header_menu_2'];
				}

				if(isset($store_website['header']['header_logo']))
				{
					$detail['logo'] = $store_website['header']['header_logo'];
				}

				if(isset($store_website['header']['topline']))
				{
					$detail['announcement'] = $store_website['header']['topline'];
				}


				$last_sort = $last_sort + 10;

				$detail = json_encode($detail, JSON_UNESCAPED_UNICODE);

				$query =
				"
					INSERT INTO pagebuilder SET
						pagebuilder.title = '$header_title',
						pagebuilder.platform = 'website',
						pagebuilder.mode = 'header',
						pagebuilder.related = 'posts',
						pagebuilder.type = '$header_code',
						pagebuilder.sort = '$last_sort',
						pagebuilder.detail = '$detail',
						pagebuilder.status = 'draft',
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_header = \dash\db::query($query, $fuel, ['database' => $dbname]);




			}
			elseif(a($store_website, 'header', 'active') === 'header_private_rafiei')
			{
				$header_title = T_("Header #rafiei");
				$header_code = 'rafiei';

				$detail = [];

				if(isset($store_website['header']['header_menu_1']))
				{
					$detail['header_menu_1'] = $store_website['header']['header_menu_1'];
				}

				if(isset($store_website['header']['header_menu_2']))
				{
					$detail['header_menu_2'] = $store_website['header']['header_menu_2'];
				}

				if(isset($store_website['header']['header_logo']))
				{
					$detail['logo'] = $store_website['header']['header_logo'];
				}

				if(isset($store_website['header']['topline']))
				{
					$detail['announcement'] = $store_website['header']['topline'];
				}


				$last_sort = $last_sort + 10;

				$detail = json_encode($detail, JSON_UNESCAPED_UNICODE);

				$query =
				"
					INSERT INTO pagebuilder SET
						pagebuilder.title = '$header_title',
						pagebuilder.platform = 'website',
						pagebuilder.mode = 'header',
						pagebuilder.related = 'posts',
						pagebuilder.type = '$header_code',
						pagebuilder.sort = '$last_sort',
						pagebuilder.detail = '$detail',
						pagebuilder.status = 'draft',
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_header = \dash\db::query($query, $fuel, ['database' => $dbname]);




			}
			else
			{
				if(a($store_website, 'status') === 'visitcard')
				{
					$query = " UPDATE posts SET posts.meta = '{\"template\": \"visitcard\"}' WHERE posts.id = $post_id LIMIT 1 ";

					\dash\db::query($query, $fuel, ['database' => $dbname]);

				}
				elseif(a($store_website, 'status') === 'comingsoon')
				{
					$query = " UPDATE posts SET posts.meta = '{\"template\": \"comingsoon\"}' WHERE posts.id = $post_id LIMIT 1 ";

					\dash\db::query($query, $fuel, ['database' => $dbname]);

				}
				else
				{

					var_dump('specail header');
					var_dump($store_website);
					exit();
				}
			}


			if(a($store_website, 'status') === 'visitcard')
			{
				$query = " UPDATE posts SET posts.meta = '{\"template\": \"visitcard\"}' WHERE posts.id = $post_id LIMIT 1 ";

				\dash\db::query($query, $fuel, ['database' => $dbname]);

			}
			elseif(a($store_website, 'status') === 'comingsoon')
			{
				$query = " UPDATE posts SET posts.meta = '{\"template\": \"comingsoon\"}' WHERE posts.id = $post_id LIMIT 1 ";

				\dash\db::query($query, $fuel, ['database' => $dbname]);

			}

		}
		// ------------------------------------------------------ HEADER  ------------------------------------------------------------------------------------------- //

		//
		//
		//
		// ------------------------------------------------------ BODY  ------------------------------------------------------------------------------------------- //

		foreach ($store_website['body'] as $key => $body_element)
		{
			if(!isset($body_element['type']))
			{
				continue;
			}

			if($body_element['type'] === 'specialslider')
			{
				$ratio = 'NULL';
				if(isset($body_element['ratio']) && $body_element['ratio'])
				{
					$ratio = ['code' => $body_element['ratio']];
					$ratio = "'". json_encode($ratio). "'";
				}



				if(isset($body_element['specialslider']) && is_array($body_element['specialslider']))
				{
					$new_detail = json_encode(['list' => $body_element['specialslider']], JSON_UNESCAPED_UNICODE);

					$last_sort = $last_sort + 10;

					$query =
					"
						INSERT INTO pagebuilder SET
							pagebuilder.title = '$body_element[title]',
							pagebuilder.platform = 'website',
							pagebuilder.mode = 'body',
							pagebuilder.related = 'posts',
							pagebuilder.type = 'image',
							pagebuilder.ratio = $ratio,
							pagebuilder.sort = '$last_sort',
							pagebuilder.status = 'draft',
							pagebuilder.datecreated = '$date',
							pagebuilder.detail = '$new_detail',
							pagebuilder.related_id = '$post_id'
					";

					$add_new_image = \dash\db::query($query, $fuel, ['database' => $dbname]);

				}
			}
			elseif($body_element['type'] === 'productline')
			{

				if(isset($body_element['productline']) && is_array($body_element['productline']))
				{
					$new_detail = json_encode($body_element['productline'], JSON_UNESCAPED_UNICODE);

					$puzzle = '{"code":null,"puzzle_type":"rail","slider_type":null,"limit":8}';

					$last_sort = $last_sort + 10;


					$query =
					"
						INSERT INTO pagebuilder SET
							pagebuilder.title = '$body_element[title]',
							pagebuilder.platform = 'website',
							pagebuilder.mode = 'body',
							pagebuilder.related = 'posts',
							pagebuilder.type = 'products',
							pagebuilder.sort = '$last_sort',
							pagebuilder.status = 'draft',
							pagebuilder.puzzle = '$puzzle',
							pagebuilder.datecreated = '$date',
							pagebuilder.detail = '$new_detail',
							pagebuilder.related_id = '$post_id'
					";

					$add_new_image = \dash\db::query($query, $fuel, ['database' => $dbname]);

				}
			}
			elseif($body_element['type'] === 'news')
			{

				$puzzle = json_encode(
				[
					'code' => a($body_element, 'puzzle'),
					'puzzle_type' => 'puzzle',
					'slider_type' => null,
					'limit' => a($body_element, 'limit'),
				], JSON_UNESCAPED_UNICODE);


				$titlesetting = json_encode(
				[
					'show_title' => a($body_element, 'show_title'),
					'more_link' => a($body_element, 'more_link'),
					'more_link_caption' => a($body_element, 'more_link_caption'),
				], JSON_UNESCAPED_UNICODE);

				$infoposition = json_encode(
				[
					'code' => a($body_element, 'info_position'),
				], JSON_UNESCAPED_UNICODE);

				$avand = json_encode(
				[
					'code' => a($body_element, 'avand'),
				], JSON_UNESCAPED_UNICODE);

				$radius = json_encode(
				[
					'code' => a($body_element, 'radius'),
				], JSON_UNESCAPED_UNICODE);

				$padding = json_encode(
				[
					'code' => a($body_element, 'padding'),
				], JSON_UNESCAPED_UNICODE);

				$effect = json_encode(
				[
					'code' => a($body_element, 'effect'),
				], JSON_UNESCAPED_UNICODE);


				$detail =
				[
					'play_item' => a($body_element, 'play_item'),
					'subtype'   => a($body_element, 'subtype'),
					'tag_id'    => a($body_element, 'tag_id'),
				];

  				$detail = json_encode($detail, JSON_UNESCAPED_UNICODE);



				$last_sort = $last_sort + 10;


				$query =
				"
					INSERT INTO pagebuilder SET
						pagebuilder.title = '$body_element[title]',
						pagebuilder.titlesetting = '$titlesetting',
						pagebuilder.infoposition = '$infoposition',
						pagebuilder.puzzle = '$puzzle',
						pagebuilder.detail = '$detail',
						pagebuilder.avand = '$avand',
						pagebuilder.radius = '$radius',
						pagebuilder.padding = '$padding',
						pagebuilder.effect = '$effect',
						pagebuilder.platform = 'website',
						pagebuilder.mode = 'body',
						pagebuilder.related = 'posts',
						pagebuilder.type = 'news',
						pagebuilder.sort = '$last_sort',
						pagebuilder.status = 'draft',
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_image = \dash\db::query($query, $fuel, ['database' => $dbname]);

			}
			elseif($body_element['type'] === 'quote')
			{
				if(in_array(a($store, 'subdomain'), ['rebaran', 'sarahonar', 'haftpeykar', 'citycloth', 'jbqazvin', 'javadchmanchi']))
				{
					// no thing
				}
				else
				{
					var_dump($store);
					var_dump('quote', $body_element);exit();
				}
			}
			elseif($body_element['type'] === 'imageblock')
			{
				$ratio = 'NULL';
				if(isset($body_element['ratio']) && $body_element['ratio'])
				{
					$ratio = ['code' => $body_element['ratio']];
					$ratio = "'". json_encode($ratio). "'";
				}

				$limit = 1;

				if(count($body_element['imageblock']) >= 1  || count($body_element['imageblock']) <= 10  )
				{
					$limit = count($body_element['imageblock']);
				}
				else
				{
					var_dump($store);
					var_dump('erro imagebloc limit', $body_element);exit();
				}



				$puzzle = '{"code":null,"puzzle_type":"puzzle","slider_type":"special","limit":'.$limit.'}';

				if(isset($body_element['imageblock']) && is_array($body_element['imageblock']))
				{
					$new_detail = json_encode(['list' => $body_element['imageblock']], JSON_UNESCAPED_UNICODE);

					$last_sort = $last_sort + 10;

					$query =
					"
						INSERT INTO pagebuilder SET
							pagebuilder.title = '$body_element[title]',
							pagebuilder.platform = 'website',
							pagebuilder.mode = 'body',
							pagebuilder.related = 'posts',
							pagebuilder.type = 'image',
							pagebuilder.sort = '$last_sort',
							pagebuilder.ratio = $ratio,
							pagebuilder.puzzle = '$puzzle',
							pagebuilder.status = 'draft',
							pagebuilder.datecreated = '$date',
							pagebuilder.detail = '$new_detail',
							pagebuilder.related_id = '$post_id'
					";

					$add_new_image = \dash\db::query($query, $fuel, ['database' => $dbname]);

				}
			}
			elseif($body_element['type'] === 'titleline')
			{
				// if(in_array(a($store, 'subdomain'), ['rebaran', 'colorfulpainting', 'sarahonar', 'shopqhkarimeh', 'sakou', 'winox', 'bikoo', 'royalestore']))
				// {
				// 	// no thing
				// }
				// else
				// {
				// 	var_dump($store);
				// 	var_dump('titleline', $body_element);exit();
				// }
			}
			elseif($body_element['type'] === 'text')
			{
				if(isset($body_element['text']['text']))
				{
					$text = $body_element['text']['text'];

					$last_sort = $last_sort + 10;

					$query =
					"
						INSERT INTO pagebuilder SET
							pagebuilder.title = '$body_element[title]',
							pagebuilder.platform = 'website',
							pagebuilder.mode = 'body',
							pagebuilder.related = 'posts',
							pagebuilder.type = 'text',
							pagebuilder.sort = '$last_sort',
							pagebuilder.status = 'draft',
							pagebuilder.datecreated = '$date',
							pagebuilder.text = '$text',
							pagebuilder.related_id = '$post_id'
					";

					$add_new_image = \dash\db::query($query, $fuel, ['database' => $dbname]);

				}
			}
			elseif($body_element['type'] === 'subscribe')
			{
				// if(in_array(a($store, 'subdomain'), ['rasulrajabi', 'jbqazvin']))
				// {
				// 	// no thing
				// }
				// else
				// {
				// 	var_dump($store);
				// 	var_dump('subscribe', $body_element);exit();
				// }
			}
			elseif($body_element['type'] === 'socialnetwork')
			{
				// if(in_array(a($store, 'subdomain'), ['jbqazvin', 'teachingideas']))
				// {
				// 	// no thing
				// }
				// else
				// {
				// 	var_dump($store);
				// 	var_dump('socialnetwork', $body_element);exit();
				// }
			}
			elseif($body_element['type'] === 'application')
			{
				// if(in_array(a($store, 'subdomain'), ['jbqazvin']))
				// {
				// 	// no thing
				// }
				// else
				// {
				// 	var_dump($store);
				// 	var_dump('application', $body_element);exit();
				// }
			}
			else
			{
				var_dump($store);
				var_dump('new body elemnt');
				var_dump($body_element);exit();
			}
		}


		// ------------------------------------------------------ BODY  ------------------------------------------------------------------------------------------- //


		// ------------------------------------------------------ FOOTER  ------------------------------------------------------------------------------------------- //


		if(isset($store_website['footer']['active']) && count($store_website['footer']) === 1)
		{
			$check_duplicate_query = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = '$post_id' AND pagebuilder.mode = 'footer' LIMIT 1 ";

			$check_duplicate = \dash\db::get($check_duplicate_query, null, true, $fuel, ['database' => $dbname]);

			if(isset($check_duplicate['id']))
			{
				$footer_id = $check_duplicate['id'];
			}
			else
			{
				if($store_website['footer']['active'] === 'footer_100')
				{
					$footer_title = T_("Footer #100");
					$footer_code = 'f100';
				}
				elseif($store_website['footer']['active'] === 'footer_private_rafiei')
				{
					$footer_title = T_("Footer #rafiei");
					$footer_code = 'rafiei';
				}
				elseif($store_website['footer']['active'] === 'footer_201')
				{
					$footer_title = T_("Footer #201");
					$footer_code = 'f201';
				}
				elseif($store_website['footer']['active'] === 'footer_300')
				{
					$footer_title = T_("Footer #300");
					$footer_code = 'f300';
				}
				else
				{
					var_dump($store_website['footer']);exit();
				}

				$last_sort = $last_sort + 10;

				$query =
				"
					INSERT INTO pagebuilder SET
						pagebuilder.title = '$footer_title',
						pagebuilder.platform = 'website',
						pagebuilder.mode = 'footer',
						pagebuilder.related = 'posts',
						pagebuilder.type = '$footer_code',
						pagebuilder.sort = '$last_sort',
						pagebuilder.status = 'draft',
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_footer = \dash\db::query($query, $fuel, ['database' => $dbname]);

				$footer_id = \dash\db::insert_id();
			}

		}
		else
		{
			if(a($store_website, 'footer', 'active') === 'footer_300' || a($store_website, 'footer', 'active') === 'footer_100')
			{

				if(count($store_website['footer']) > 2)
				{
					var_dump($store_website['footer']);
					exit();
				}

				$footer_title = T_("Footer #100");
				$footer_code = 'f100';

				$detail = [];

				$text = 'NULL';

				if(isset($store_website['footer']['maintext']['text']))
				{
					$text = "'". $store_website['footer']['maintext']['text']. "'";
				}


				$last_sort = $last_sort + 10;

				$detail = json_encode($detail, JSON_UNESCAPED_UNICODE);

				$query =
				"
					INSERT INTO pagebuilder SET
						pagebuilder.title = '$footer_title',
						pagebuilder.platform = 'website',
						pagebuilder.mode = 'footer',
						pagebuilder.related = 'posts',
						pagebuilder.type = '$footer_code',
						pagebuilder.sort = '$last_sort',
						pagebuilder.detail = '$detail',
						pagebuilder.status = 'draft',
						pagebuilder.text = $text,
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_header = \dash\db::query($query, $fuel, ['database' => $dbname]);




			}
			elseif(a($store_website, 'footer', 'active') === 'footer_201')
			{

				$footer_title = T_("Footer #201");
				$footer_code = 'f201';

				$detail = [];

				if(isset($store_website['footer']['footer_menu_1']))
				{
					$detail['footer_menu_1'] = $store_website['footer']['footer_menu_1'];
				}

				if(isset($store_website['footer']['footer_menu_2']))
				{
					$detail['footer_menu_2'] = $store_website['footer']['footer_menu_2'];
				}

				if(isset($store_website['footer']['footer_menu_3']))
				{
					$detail['footer_menu_3'] = $store_website['footer']['footer_menu_3'];
				}


				if(isset($store_website['footer']['footer_menu_4']))
				{
					$detail['footer_menu_4'] = $store_website['footer']['footer_menu_4'];
				}

				$text = 'NULL';

				if(isset($store_website['footer']['maintext']['text']))
				{
					$text = "'". $store_website['footer']['maintext']['text']. "'";
				}


				$last_sort = $last_sort + 10;

				$detail = json_encode($detail, JSON_UNESCAPED_UNICODE);

				$query =
				"
					INSERT INTO pagebuilder SET
						pagebuilder.title = '$footer_title',
						pagebuilder.platform = 'website',
						pagebuilder.mode = 'footer',
						pagebuilder.related = 'posts',
						pagebuilder.type = '$footer_code',
						pagebuilder.sort = '$last_sort',
						pagebuilder.detail = '$detail',
						pagebuilder.status = 'draft',
						pagebuilder.text = $text,
						pagebuilder.datecreated = '$date',
						pagebuilder.related_id = '$post_id'
				";

				$add_new_header = \dash\db::query($query, $fuel, ['database' => $dbname]);




			}
			elseif(a($store_website, 'status') === 'visitcard')
			{
				// nothing
			}
			else
			{
				var_dump('specail footer');
				var_dump($store_website);
				exit();
			}
		}
		// ------------------------------------------------------ FOOTER  ------------------------------------------------------------------------------------------- //


	}
}