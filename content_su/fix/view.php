<?php
namespace content_su\fix;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		self::fix();


	}



	private static function fix()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		$file_error = [];
		$duplicate = 0;
		$run = 0;

		foreach ($list as $key => $value)
		{
			$query = "	SELECT * FROM posts  ";
			$store_id = $value['id'];
			$dbname = \dash\engine\store::make_database_name($store_id);
			$resutl = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);
			if($resutl)
			{
				foreach ($resutl as $one_post)
				{

					$query = "	SELECT terms.id AS `term_id`, terms.title, terms.url FROM termusages INNER JOIN terms ON terms.id = termusages.term_id WHERE termusages.post_id = $one_post[id] AND termusages.type = 'tag' ";
					$tags = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);

					$seo_detail            = [];
					$seo_detail['type']    = 'post';
					$seo_detail['id']      = a($one_post, 'id');
					$seo_detail['title']   = a($one_post, 'title');
					$seo_detail['seodesc'] = a($one_post, 'excerpt');
					$seo_detail['content'] = a($one_post, 'content');
					$seo_detail['tags']    = $tags;

					$seoAnalyze    = \dash\seo::analyze($seo_detail);

					if(isset($seoAnalyze['rank']))
					{
						$args['seorank'] = $seoAnalyze['rank'];
						\dash\db::get("UPDATE posts SET posts.seorank = $seoAnalyze[rank] WHERE posts.id = $one_post[id] LIMIT 1", $value['fuel'], ['database' => $dbname]);

					}


				}
			}
		}

		var_dump('ok');
		exit();
	}
}
?>