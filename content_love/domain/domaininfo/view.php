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

		$q = \dash\request::get('q');
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
				var_dump($q);
				$get_domain_info = \lib\onlinenic\api::info_domain($q);
				var_dump($get_domain_info);exit();
			}
			\dash\data::DomainInfo($info);
		}

	}
}
?>
