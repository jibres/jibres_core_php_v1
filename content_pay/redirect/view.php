<?php
namespace content_pay\redirect;


class view
{
	public static function config()
	{
		\dash\face::title(T_('redirecting...'));
		\dash\face::desc(T_('in redirect process...'));


		$autoredirect = \dash\temp::get('autoredirect');

		if(!empty($autoredirect))
		{
			\dash\data::autoredirect($autoredirect);

			\dash\session::set('redirect_page_url', null);
			\dash\session::set('redirect_page_method', null);
			\dash\session::set('redirect_page_args', null);
			\dash\session::set('redirect_page_title', null);
			\dash\session::set('redirect_page_button', null);
		}
	}
}
?>