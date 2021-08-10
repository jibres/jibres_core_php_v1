<?php
namespace content_site\page\settings;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'page')
		{
			return self::remove_page();
		}


		$post = [];

		if(\dash\request::post('set_title'))
		{
			$post['title'] = \dash\request::post('title');
		}

		\dash\app\posts\edit::edit($post, \dash\data::currentPageDetail_id());

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::complete();
		}
	}


	/**
	 * Removes a page.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function remove_page()
	{
		$page_id = \dash\request::get('id');

		$page_id = \dash\validate::code($page_id);
		$page_id = \dash\coding::decode($page_id);
		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}

		\lib\db\sitebuilder\delete::page($page_id);

		\dash\notif::ok(T_("Page removed"));

		\dash\redirect::to(\dash\url::here());

	}
}
?>