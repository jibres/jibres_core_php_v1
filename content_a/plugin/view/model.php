<?php
namespace content_a\plugin\view;


class model
{
	public static function post()
	{

		$args               = [];
		$args['use_budget'] = \dash\request::post('use_budget');
		$args['periodic']   = \dash\request::post('periodic');
		$args['package']    = \dash\request::post('package');

		$args['turn_back']  = \dash\url::pwd();
		$args['page_url']   = \dash\data::currentPageDetail_link();
		$args['plugin']     = \dash\data::pluginKey();


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

	}
}
?>