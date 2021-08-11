<?php
namespace content_site\page\new;


class model
{
	public static function post()
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

		$namespace = '\\content_site\\template\\site\\%s';
		$namespace = sprintf($namespace, $key);

		if(!is_callable([$namespace, 'records']))
		{
			\dash\notif::error(T_("Invalid template key"));
			return false;
		}

		$records = call_user_func([$namespace, 'records']);

		$post =
		[
			'title' => $title,
			'type'  => 'pagebuilder',
		];

		$post_detail = \dash\app\posts\add::add($post, true);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
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
			$insert['mode']           = a($value, 'mode');
			$insert['type']           = a($value, 'preview', 'type');
			$insert['related']        = 'posts';
			$insert['related_id']     = $page_id;
			$insert['title']          = null;
			$insert['preview']        = json_encode(a($value, 'preview'));
			$insert['status']         = 'draft';
			$insert['status_preview'] = 'draft';
			$insert['datecreated']    = date("Y-m-d H:i:s");
			$insert['sort']           = $key + 1;
			$insert['sort_preview']   = $insert['sort'];

			$id = \lib\db\sitebuilder\insert::new_record($insert);

		}

		\dash\redirect::to(\dash\url::this(). '?id='. $post_detail['post_id']);

	}
}
?>