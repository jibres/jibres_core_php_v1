<?php
namespace content_site;


class model
{
	public static function check_auto_save_page()
	{
		// need to save and publish page
		if(!\lib\store::detail('force_stop_sitebuilder_auto_save'))
		{
			\content_site\page\model::save_page(\dash\request::get('id'));
		}
	}


	public static function check_homepage_permission()
	{

		// check homepage access
		$homepage_id = \content_site\homepage::code();
		$page_id     = \dash\request::get('id');

		if($page_id && $page_id === $homepage_id)
		{
			\dash\permission::check('manageHomepage');
		}
	}
}
