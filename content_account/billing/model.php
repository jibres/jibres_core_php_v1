<?php
namespace content_account\billing;


class model
{

	/**
	 * get billing data to show
	 */
	public static function get_billing()
	{
		if(!\dash\user::login())
		{
			return false;
		}

		$billing_history = \dash\app\transaction\search::user_history(\dash\user::id());

		return $billing_history;
	}

	/**
	 * post data and update or insert billing data
	 */
	public static function post()
	{
		if(!\dash\user::login())
		{
			\dash\notif::error(T_("You must login to pay amount"));
			return false;
		}


		if(\dash\request::post('check') === 'again')
		{
			$result = \dash\app\transaction\edit::verify_again(\dash\request::post('id'));
			if($result)
			{
				\dash\redirect::pwd();
			}
		}

		$meta =
		[
			'turn_back' => \dash\url::pwd(),
			'user_id'   => \dash\user::id(),
			'amount'    => \dash\request::post('amount'),
		];

		\dash\utility\pay\start::site($meta);


	}





}
?>