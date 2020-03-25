<?php
namespace content_account\billing;

class view
{
	public static function config()
	{

		\dash\data::amount(\dash\request::get('amount'));
		\dash\face::title(T_("Billing information"));

		\dash\data::action_link(\dash\url::here());
		\dash\data::action_text(T_('Back to Account'));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('Account'));


		// back
		\dash\data::back_text(T_('Account'));
		\dash\data::back_link(\dash\url::here());

		if(\dash\user::login())
		{

			\dash\data::userUnit(T_("Toman"));

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