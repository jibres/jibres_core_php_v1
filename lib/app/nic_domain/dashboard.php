<?php
namespace lib\app\nic_domain;


class dashboard
{
	public static function admin()
	{
		\dash\permission::access('showDomainStats');

		$result                          = [];
		$result['sale_count_today']      = 1;
		$result['sale_count_yesterday']  = 100;

		$result['sale_count_last_week']  = 1000;
		$result['sale_count_last_month'] = 10000;
		$result['sale_count_total']      = 100000;

		$result['total_buyers']          = 1000000;
		$result['total_log']             = 10000000;
		$result['total_domain_buy']      = 100000000;
		$result['total_domain_renew']    = 1000000000;
		$result['total_domain_transfer'] = 10000000000;
		$result['total_domain_whois']    = 100000000000;



		return $result;
	}
}
?>