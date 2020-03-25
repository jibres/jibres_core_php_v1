<?php
namespace content_crm\sms\home;

class view
{
	public static function config()
	{
		if(!\dash\permission::supervisor())
		{
			\dash\header::status(403);
		}


		\dash\permission::access('cpSMS');

		\dash\face::title(T_("SMS Dashboard"));

		\dash\data::action_link(\dash\url::here());
		\dash\data::action_text(T_('Dashboard'));

		$get_balance = \dash\session::get('sms_panel_detail');
		if(!$get_balance)
		{
			$default =
			[
				'remaincredit' => null,
				'expiredate'   => null,
				'type'         => 'Unknow',
			];
			$get_balance = \dash\utility\sms::info();

			if(is_array($get_balance))
			{
				$get_balance = array_merge($default, $get_balance);
			}

			\dash\session::set('sms_panel_detail', $get_balance, null, (60 * 10));
		}

		\dash\data::SMSbalance($get_balance);

	}
}
?>