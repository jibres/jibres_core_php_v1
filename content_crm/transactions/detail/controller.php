<?php
namespace content_crm\transactions\detail;

class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTransactionsList');

		$id = \dash\request::get('id');

		$load = \dash\app\transaction\get::getReadyFull($id);

		if(!$load)
		{
			\dash\header::status(404);
		}


		\dash\data::dataRow($load);
	}
}
?>