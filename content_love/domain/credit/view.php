<?php
namespace content_love\domain\credit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain info"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


		$info = \lib\app\nic_domain\get::credit();
		\dash\data::DomainInfo($info);


		$log_id = \dash\temp::get('IRNIC-last-log-id');
		if($log_id)
		{
			\dash\data::action_link(\dash\url::this(). '/log/view?id='. $log_id);
			\dash\data::action_text(T_("Show log"));
		}
	}
}
?>
