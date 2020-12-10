<?php
namespace content_cms;

class controller
{

	public static function routing()
	{
		\dash\redirect::to_login();

		\dash\permission::access('_group_cms');


		if(\dash\request::get('fix1') === 'fix1')
		{
			self::fix();
		}

	}


	private static function fix()
	{
		$store_list = \lib\db\store\get::all_store_fuel_detail();

		$count = 0;
		$count_post = 0;
		foreach ($store_list as $key => $value)
		{
			$dbname = \dash\engine\store::make_database_name($value['id']);

			$load_post = \dash\db::get("SELECT * FROM posts", null, false, $value['fuel'], ['database' => $dbname]);

			if(!$load_post || !is_array($load_post))
			{
				continue;
			}


			foreach ($load_post as $post_detail)
			{
				if(isset($post_detail['meta']))
				{
					$meta = json_decode($post_detail['meta'], true);
					if(isset($meta['gallery']))
					{
						$new_gallery = json_encode($meta['gallery'], JSON_UNESCAPED_UNICODE);

						\dash\db::query("UPDATE  posts SET posts.gallery = '$new_gallery' WHERE posts.id = $post_detail[id] LIMIT 1 ", $value['fuel'], ['database' => $dbname]);

					}
					if(isset($meta['thumb']))
					{
						\dash\db::query("UPDATE  posts SET posts.thumb = '$meta[thumb]' WHERE posts.id = $post_detail[id] LIMIT 1 ", $value['fuel'], ['database' => $dbname]);
					}
				}
			}


			$count++;
			$count_post += count($load_post);
		}
		var_dump($count, $count_post);
		var_dump(111);exit();
	}
}
?>