<?php
namespace content_site\page\factor;


class model
{
	public static function post()
	{
		if(\dash\request::post('pay') === 'pay')
		{
			self::pay_page_factor();
		}

	}


	/**
	 * Removes a page.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function pay_page_factor()
	{
		$page_factor = view::page_factor();

		if(!$page_factor)
		{
			\dash\notif::error_once(T_("Nothing to pay"));
			return false;
		}

		var_dump($page_factor);exit;

	}
}
?>