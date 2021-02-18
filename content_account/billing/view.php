<?php
namespace content_account\billing;

class view
{
	public static function config()
	{

		\dash\data::amount(\dash\request::get('amount'));
		\dash\face::title(T_("Billing information"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('Account'));

		if(\dash\request::get('from') === 'domain')
		{
			\dash\data::back_text(T_('Domains'));
			\dash\data::back_link(\dash\url::kingdom(). '/my/domain');
		}
		else
		{
			// back
			\dash\data::back_text(T_('Account'));
			\dash\data::back_link(\dash\url::here());
		}

		if(\dash\user::login())
		{

			\dash\data::userUnit(\lib\currency::unit());

			$user_cash_all = \dash\db\transactions::budget(\dash\user::id(), ['unit' => 'all']);

			// if(is_array($user_cash_all))
			// {
			// 	$user_cash_all['total']    = array_sum($user_cash_all);
			// }
			\dash\data::userCash($user_cash_all);

			\dash\data::history(\content_account\billing\model::get_billing());
		}
	}



}
?>