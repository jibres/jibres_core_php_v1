<?php
namespace content_crm\transactions\edit;

class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTransactionsList');

		$id = \dash\request::get('id');

		$load = \dash\app\transaction\get::get($id);

		if(!$load)
		{
			\dash\header::status(404);
		}

		if(isset($load['payment']) && $load['payment'])
		{
			\dash\header::status(403, T_("Can not edit payment transactions"));
		}

		\dash\data::dataRow($load);
	}
}
?>