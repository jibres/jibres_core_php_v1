<?php
namespace content_my\domain\review;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();


		$id = \dash\validate::code(\dash\request::get('id'));
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\header::status(404, T_("Id not found"));
		}

		$detail = \lib\app\nic_domain\get::by_id($id);
		if(!$detail)
		{
			\dash\header::status(404, T_("Detail not found"));
		}

		if(isset($detail['status']) && $detail['status'] === 'awaiting')
		{
			// nothing
		}
		else
		{
			\dash\header::status(404, T_("Detail is wrong!"));
		}

		$load_last_activity = \lib\app\nic_domainaction\get::last_record_domain_id_caller($id, 'domain_buy_ready');
		\dash\data::dataRowAction($load_last_activity);
		\dash\data::dataRow($detail);

	}
}
?>