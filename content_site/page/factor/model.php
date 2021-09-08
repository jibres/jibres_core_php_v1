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
	public static function pay_page_factor()
	{
		$page_factor = view::page_factor();

		if(!$page_factor)
		{
			\dash\notif::error_once(T_("Nothing to pay"));
			return false;
		}


		$args                  = [];
		$args['use_as_budget'] = \dash\request::post('use_as_budget');
		$args['turn_back']     = \dash\url::this(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'auto' => 'save']);

		foreach ($page_factor as $key => $value)
		{
			$args['feature_'. $key] = a($value, 'feature_key');
		}

		$result = \lib\jpi\features::pay($args);


		if(isset($result['result']['pay_link']))
		{
			\dash\redirect::to($result['result']['pay_link']);
			return;
		}

		if(isset($result['result']['features_enabled']) && $result['result']['features_enabled'])
		{
			\content_site\page\model::save_page();
			$page_url = \dash\url::this(). '?'. \dash\request::build_query(['id' => \dash\request::get('id')]);
			\dash\redirect::to($page_url);
			return;
		}
		else
		{
			\dash\notif::error_once(T_("Unknown error"). ' ' . __LINE__);
			return false;
		}

	}
}
?>