<?php
namespace content_my\domain\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Jibres Domain Center"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('Buy your dream domain'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/buy');

		\dash\face::help(\dash\url::support().'/domain');

		$dashboard_detail = \lib\app\nic_domain\dashboard::user();
		\dash\data::dashboardDetail($dashboard_detail);

		\dash\data::loadScript('/js/chart/my/domainhomepage.js');


		if(\dash\request::get('token'))
		{
			$get_msg = \dash\utility\pay\setting::final_msg(\dash\request::get('token'));
			if($get_msg)
			{
				if(isset($get_msg['condition']) && $get_msg['condition'] === 'ok' && isset($get_msg['plus']))
				{
					\dash\data::paymentVerifyMsg(T_("Payment successfull", ['amount' => \dash\fit::number($get_msg['plus'])]));
					\dash\data::paymentVerifyMsgTrue(true);
				}
				else
				{
					\dash\data::paymentVerifyMsg(T_("Payment unsuccessfull"));
				}
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}


	}
}
?>
