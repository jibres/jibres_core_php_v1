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


		$result = \lib\api\jibres\api::plugin_activate($args);

		if(isset($result['result']['pay_link']))
		{
			\dash\redirect::to($result['result']['pay_link']);
			return;
		}

		if(isset($result['result']['plugin_enabled']) && $result['result']['plugin_enabled'])
		{
			\dash\notif::ok(T_("This plugin is already activated"));
			\dash\redirect::pwd();
			return;
		}
		else
		{
			\dash\notif::generate_jibres_api_notif($result);
			return false;
		}


	}
}
?>