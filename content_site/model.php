<?php
namespace content_site;


class model
{
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
