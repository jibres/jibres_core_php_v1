<?php
namespace content_a\setting\legal;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Legal Setting'));

		// back
		\dash\data::back_text(T_('Website Builder'));
		\dash\data::back_link(\dash\url::kingdom(). '/site');
		\dash\data::back_direct(true);

		$load = \lib\app\setting\policy_page::admin_load();

		\dash\data::policyPageDetail($load);

		$have_any_published_post = \dash\app\posts\get::have_any_published_post();
		\dash\data::havePublishedPost($have_any_published_post);
	}
}
?>