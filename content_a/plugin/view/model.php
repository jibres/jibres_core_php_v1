<?php
namespace content_a\plugin\view;


class model
{
	public static function post()
	{

		$args                                     = [];
		$args['use_budget']                       = \dash\request::post('use_budget');
		$args['turn_back']                        = \dash\url::this(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'auto' => 'save']);
		$args['page_url']                         = \dash\data::currentPageDetail_link();
		$args['plugin_'. \dash\data::pluginKey()] = \dash\data::pluginKey();


		$result = \lib\api\jibres\api::enable_plugin($args);

		var_dump($result);exit;

		if(isset($result['result']['pay_link']))
		{
			\dash\redirect::to($result['result']['pay_link']);
			return;
		}

		if(isset($result['result']['plugin_enabled']) && $result['result']['plugin_enabled'])
		{
			\content_site\page\model::save_page();
			$page_url = \dash\url::this(). '?'. \dash\request::build_query(['id' => \dash\request::get('id')]);
			\dash\redirect::to($page_url);
			return;
		}
		else
		{
			\dash\notif::error_once(T_("Unknown error"). ' ' . __LINE__);
			return false;
		}

		var_dump($post);exit;


		$result = \lib\app\plugin\add::duplicate($post, \dash\request::get('id'));

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
		}


		\dash\notif::complete();


	}
}
?>