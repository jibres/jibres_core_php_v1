<?php
namespace content_site\page\new;


class model
{
	public static function post()
	{
		if(!\dash\temp::get('initHomepageArgs'))
		{
			if(\dash\request::post('temptitle'))
			{
				$title = \dash\validate::title(\dash\request::post('title'), false);
				\dash\session::set('mySiteBuilderPageTitle', $title);
				\dash\notif::complete();
				return;
			}

			$title = \dash\session::get('mySiteBuilderPageTitle');
			if(!$title)
			{
				$title = T_("Untitled page");
			}

			$key = \dash\request::post('key');
			$key = \dash\validate::string_100($key);
			if(!$key)
			{
				\dash\notif::error(T_("Please select one template"));
				return false;
			}
		}
		else
		{
			$title = a(\dash\temp::get('initHomepageArgs'), 'title');
			$key = a(\dash\temp::get('initHomepageArgs'), 'key');
		}


		$records = [];

		if($key !== 'blank')
		{

			$namespace = '\\content_site\\template\\site\\%s';
			$namespace = sprintf($namespace, $key);

			if(!is_callable([$namespace, 'records']))
			{
				\dash\notif::error(T_("Invalid template key"));
				return false;
			}

			$records = call_user_func([$namespace, 'records']);

		}

		$post =
		[
			'title' => $title,
			'type'  => 'pagebuilder',
			'status' => 'publish',
		];

		$post_detail = \dash\app\posts\add::add($post, true);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{

			// clean post created and make page created
			\dash\notif::clean();
			\dash\notif::ok(T_("Page successfully created"));

			$page_id = \dash\coding::decode($post_detail['post_id']);
		}
		else
		{
			\dash\notif::error(T_("Can not add your page!"));
			return false;
		}


		$insert_pagebuilder_record = [];

		foreach ($records as $key => $value)
		{
			$insert                   = [];

			$insert['mode']        = a($value, '_mode');
			$insert['folder']      = a($value, '_folder');
			$insert['section']     = a($value, '_section');
			$insert['model']       = a($value, '_model');
			$insert['preview_key'] = a($value, '_preview_key');

			unset($value['_model']);
			unset($value['_folder']);
			unset($value['_section']);
			unset($value['_model']);
			unset($value['_preview_key']);



			$insert['related']        = 'posts';
			$insert['related_id']     = $page_id;
			$insert['title']          = null;
			$insert['preview']        = json_encode($value);
			$insert['status']         = 'draft';
			$insert['status_preview'] = 'draft';
			$insert['datecreated']    = date("Y-m-d H:i:s");
			$insert['sort']           = $key + 1;
			$insert['sort_preview']   = $insert['sort'];

			\lib\db\sitebuilder\insert::new_record($insert);

		}

		\dash\session::set('mySiteBuilderPageTitle', null);

		if(\dash\temp::get('initHomepageArgs'))
		{
			// needless to redirect
			return;
		}

		\dash\redirect::to(\dash\url::this(). '?id='. $post_detail['post_id']);

	}


	public static function init_homepage()
	{
		$args =
		[
			'title' => T_("Homepage"),
			'key' => 'demo_001',
		];

		\dash\temp::set('initHomepageArgs', $args);

		self::post();

		\dash\notif::clean();

	}
}
?>