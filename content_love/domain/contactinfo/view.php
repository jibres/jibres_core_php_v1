<?php
namespace content_love\domain\contactinfo;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Contact info"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$q = \dash\validate::search_string();
		if($q)
		{
			if($q = \dash\validate::irnic_id($q, false))
			{
				$info = \lib\app\nic_contact\get::info($q);
				$log_id = \dash\temp::get('IRNIC-last-log-id');
				if($log_id)
				{
					\dash\data::action_link(\dash\url::this(). '/log/view?id='. $log_id);
					\dash\data::action_text(T_("Show log"));
				}
				\dash\data::DomainInfo($info);
			}
			else
			{
				\dash\notif::error(T_("Invalid contact id"));
				// $info = \lib\api\onlinenic\api::info_domain($q);
				// $log_id = \dash\temp::get('ONLINENIC-last-log-id');
				// if($log_id)
				// {
				// 	\dash\data::action_link(\dash\url::this(). '/onlineniclog/view?id='. $log_id);
				// 	\dash\data::action_text(T_("Show log"));
				// }
			}
		}

	}
}
?>
