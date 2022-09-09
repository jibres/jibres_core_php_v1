<?php
namespace dash\app\posts;

class add
{

	public static function add($_args, $_force = false)
	{
		if($_force)
		{
			// force add new post. pagebuilder mode
		}
		else
		{
			\dash\permission::access('cmsManagePost');
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		// check args
		$args = \dash\app\posts\check::variable($_args, null, $_force);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!$args['title'])
		{
			\dash\notif::error(T_("Title is required"));
			return false;
		}

		$tags = [];
		if($args['tags'])
		{
			$tags = $args['tags'];
		}

		unset($args['tags']);

		$args['user_id'] = \dash\user::id();

		// inset seorank

		$seo_detail            = [];
		$seo_detail['type']    = 'post';
		$seo_detail['id']      = null;
		$seo_detail['title']   = a($args, 'title') . ' | '. \dash\face::hereTitle();
		$seo_detail['seodesc'] = a($args, 'excerpt');
		$seo_detail['content'] = a($args, 'content');
		// $seo_detail['tags'] = a($args, 'tags');

		$seoAnalyze    = \dash\seo::analyze($seo_detail);

		if(isset($seoAnalyze['rank']))
		{
			$args['seorank'] = $seoAnalyze['rank'];
		}

		$return         = [];

		$content = false;
		if(array_key_exists('content', $args))
		{
			$content = $args['content'];
			unset($args['content']);
		}

		if(\dash\temp::get('analyzeCotent') && is_array(\dash\temp::get('analyzeCotent')))
		{
			$args['analyzecontent'] = json_encode(\dash\temp::get('analyzeCotent'));
		}

		$post_id = null;
		if(!empty($args))
		{
			$post_id = \dash\db\posts\insert::new_record($args);
		}

		if(!$post_id)
		{
			\dash\log::oops('dbErrorInsertPost', T_("No way to insert post"));
			return false;
		}

		if($content !== false && $post_id)
		{
			\dash\db\posts\update::update_content($content, $post_id);
		}

		if($content)
		{
			$tags = \dash\app\terms\find::tag($content, $tags);
		}

		if(array_key_exists('tags', $_args) || $tags)
		{
			\dash\app\posts\terms::save_post_term($tags, $post_id, 'tag');
		}

		if(isset($args['status']) && $args['status'] === 'publish')
		{
			\dash\utility\sitemap::posts($post_id);
		}


		$return['post_id'] = \dash\coding::encode($post_id);

		\dash\log::set('addNewPost', ['code' => $post_id, 'datalink' => $return['post_id']]);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Post successfuly added"));
		}

		return $return;
	}
}
?>