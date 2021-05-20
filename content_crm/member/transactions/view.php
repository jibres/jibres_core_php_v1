<?php
namespace content_crm\member\transactions;

class view extends \content_crm\transactions\view
{

	public static function config()
	{
		$args =
		[
			'user_code' => \dash\request::get('id')
		];

		\dash\temp::set('TransactioArgsSearch', $args);

		parent::config();

		\content_crm\member\master::view();

		\dash\face::title(T_("Transactions"));

		\dash\face::btnSetting(null);
	}

}
?>