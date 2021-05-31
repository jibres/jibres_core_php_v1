<?php
namespace content_a\setting\legal\choosepage;

class controller
{
	public static function routing()
	{

		$policy_page = \lib\app\setting\policy_page::get_page_key();

		$page = \dash\request::get('page');

		if(is_string($page) && in_array($page, array_keys($policy_page)))
		{
			\dash\data::currentPolicyPage($page);
			\dash\data::currentPolicyPageDetail($policy_page[$page]);
			// ok
		}
		else
		{
			\dash\header::status(404);
		}


	}
}
?>