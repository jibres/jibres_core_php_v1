<?php
namespace content_crm\member\billing;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Billing information"));

		\content_crm\member\main\view::dataRowMember();

		$user_id = \dash\coding::decode(\dash\request::get('id'));


		\dash\data::userUnit(\lib\currency::unit());

		$user_cash_all = \dash\db\transactions::budget($user_id, ['unit' => 'all']);

		\dash\data::userCash($user_cash_all);


		$meta            = [];
		$meta['user_id'] = $user_id;
		$meta['verify']  = 1;
		$billing_history = \dash\db\transactions::search(null, $meta);
		\dash\data::history($billing_history);
	}
}
?>