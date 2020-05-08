<?php
namespace content_love\domain\credit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("IRNIC Credit info"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


		$creditList = \lib\app\nic_credit\get::fetch();
		\dash\data::DomainInfo($creditList);

		$last = \lib\app\nic_credit\get::last();
		\dash\data::lastCredit($last);


		$log_id = \dash\temp::get('IRNIC-last-log-id');
		if($log_id)
		{
			\dash\data::action_link(\dash\url::this(). '/log/view?id='. $log_id);
			\dash\data::action_text(T_("Show log"));
		}
	}
}
?>
