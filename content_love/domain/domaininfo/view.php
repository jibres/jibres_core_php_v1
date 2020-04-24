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
			$info = \lib\app\nic_domain\get::info($q);
			\dash\data::DomainInfo($info);
		}

		$log_id = \dash\temp::get('IRNIC-last-log-id');
		if($log_id)
		{
			\dash\data::action_link(\dash\url::this(). '/log/view?id='. \dash\data::lastLogId());
			\dash\data::action_text(T_("Show log"));
		}
	}
}
?>
