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

		$args = array_column($page_factor, 'feature_key');

		$pay_url = \lib\jpi\features::pay($args);

		if($pay_url)
		{
			\dash\redirect::to($pay_url);
			return;
		}

		var_dump($page_factor);exit;

	}
}
?>