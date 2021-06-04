<?php
namespace content\domains\search;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Domain Name Search'));
		\dash\face::desc(T_('Every website starts with a great domain name.'). ' '. T_('Find your dream domain.'));
		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::kingdom(). '/domains');

		$q = \dash\validate::search_string();
		$q = \dash\validate::domain_root($q);
		if($q)
		{
			\dash\data::myDomain($q);

			self::check_limit();

			$info = \lib\app\domains\check::multi_check($q);
			\dash\data::infoResult($info);
		}
	}


	private static function check_limit()
	{

		$check_log           = [];
		$check_log['caller'] = 'check_domain_request';

		$this_hour           = date("Y-m-d H:i:s", (time() - (60*60)));

		if(\dash\user::id())
		{
			$check_log['from']   = \dash\user::id();

			$get_count_log = \dash\db\logs::count_where_date($check_log, $this_hour);

			if($get_count_log > 50)
			{
				\dash\waf\ip::isolateIP(1, 'check_domain_request per user');
			}
		}
		else
		{
			$check_log['ip_id']   = \dash\utility\ip::id();

			$get_count_log = \dash\db\logs::count_where_date($check_log, $this_hour);

			if($get_count_log > 50)
			{
				\dash\waf\ip::isolateIP(2, 'check_domain_request per ip');
			}
		}

		\dash\log::set('check_domain_request');
	}
}
?>