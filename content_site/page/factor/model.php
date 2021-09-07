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


		$args                  = [];
		$args['use_as_budget'] = 1;
		$args['turn_back']     = \dash\url::path();

		foreach ($page_factor as $key => $value)
		{
			$args['feature_'. $key] = a($value, 'feature_key');
		}

		$pay_url = \lib\jpi\features::pay($args);

		if(isset($pay_url['result']['pay_link']))
		{
			\dash\redirect::to($pay_url['result']['pay_link']);
			return;
		}

		// var_dump($pay_url);
		var_dump($page_factor);exit;

	}
}
?>