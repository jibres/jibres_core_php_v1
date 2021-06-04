<?php
namespace content_love\domain\domaininfo;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain info"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$q = \dash\validate::search_string();
		if($q)
		{
			if(\dash\validate::ir_domain($q, false))
			{
				$info = \lib\app\nic_domain\get::info($q);
				$log_id = \dash\temp::get('IRNIC-last-log-id');
				if($log_id)
				{
					\dash\data::action_link(\dash\url::this(). '/log/view?id='. $log_id);
					\dash\data::action_text(T_("Show log"));
				}
			}
			else
			{
				$info = \lib\onlinenic\api::info_domain($q);
				$log_id = \dash\temp::get('ONLINENIC-last-log-id');
				if($log_id)
				{
					\dash\data::action_link(\dash\url::this(). '/onlineniclog/view?id='. $log_id);
					\dash\data::action_text(T_("Show log"));
				}
			}
			\dash\data::DomainInfo($info);
		}

	}
}
?>
