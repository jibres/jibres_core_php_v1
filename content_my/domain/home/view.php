<?php
namespace content_my\domain\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Jibres Domain Center"));
		\dash\face::specialTitle(true);

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('Buy your dream domain'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/buy');

		\dash\face::btnImport(\dash\url::this().'/import');

		\dash\face::help(\dash\url::support().'/domain');

		$dashboard_detail = \lib\app\nic_domain\dashboard::user();
		\dash\data::dashboardDetail($dashboard_detail);

		\dash\data::global_scriptChart('my/domainhomepage.js');


		if(\dash\request::get('token'))
		{
			$get_msg = \dash\utility\pay\setting::final_msg(\dash\request::get('token'));

			if($get_msg)
			{
				$domain = isset($get_msg['payment_response']['final_fn_args']['domain']) ? $get_msg['payment_response']['final_fn_args']['domain'] : null;
				$period = isset($get_msg['payment_response']['final_fn_args']['period']) ? $get_msg['payment_response']['final_fn_args']['period'] : null;


				if(isset($get_msg['condition']) && $get_msg['condition'] === 'ok' && isset($get_msg['plus']))
				{
					if($domain)
					{
						$msg = T_("Domain :domain was registered in your name", ['domain' => $domain]);
						$msg .= '<br>';
					}
					else
					{
						$msg = T_("Payment successful");
						$msg .= '<br>';
					}

					\dash\notif::ok(1,['timeout' => 0, 'alerty' => true, 'html' => $msg]);

				}
				else
				{
					$msg = T_("Payment unsuccessful");
					$msg .= '<br>';
					\dash\notif::error(1,['timeout' => 0, 'alerty' => true, 'html' => $msg]);
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
