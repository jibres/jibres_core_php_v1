<?php
namespace content_love\domain\domaincheck;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain check"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$q = \dash\request::get('q');
		if($q)
		{
			$check = \lib\app\nic_domain\get::check($q);
			\dash\data::DomainInfo($check);
		}

		$log_id = \dash\temp::get('IRNIC-last-log-id');
		if($log_id)
		{
			\dash\data::action_link(\dash\url::this(). '/log/view?id='. $log_id);
			\dash\data::action_text(T_("Show log"));
		}
	}
}
?>
