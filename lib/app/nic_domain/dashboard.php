<?php
namespace lib\app\nic_domain;


class dashboard
{
	public static function admin()
	{
		\dash\permission::access('showDomainStats');

		$today      = date("Y-m-d");
		$yesterday  = date("Y-m-d", strtotime("yesterday"));
		$last_week  = date("Y-m-d", strtotime("-1 week"));
		$last_month = date("Y-m-d", strtotime("-1 month"));


		$result                          = [];
		$result['sale_count_today']      = \lib\db\nic_domainaction\get::sale_count_date($today);
		$result['sale_count_yesterday']  = \lib\db\nic_domainaction\get::sale_count_date($yesterday);
		$result['sale_count_last_week']  = \lib\db\nic_domainaction\get::sale_count_date($last_week);
		$result['sale_count_last_month'] = \lib\db\nic_domainaction\get::sale_count_date($last_month);
		$result['sale_count_total']      = \lib\db\nic_domainaction\get::sale_count_date();


		$result['total_buyers']          = \lib\db\nic_domainaction\get::total_buyers();
		$result['total_log']             = \lib\db\nic_log\get::count_all();
		$result['total_domain_buy']      = 100000000;
		$result['total_domain_renew']    = 1000000000;
		$result['total_domain_transfer'] = 10000000000;
		$result['total_domain_whois']    = 100000000000;



		return $result;
	}
}
?>