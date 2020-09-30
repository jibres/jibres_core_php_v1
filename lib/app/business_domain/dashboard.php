<?php
namespace lib\app\business_domain;

class dashboard
{

	public static function count_all_domain()
	{
		$result = \lib\db\business_domain\get::count_all();
		return floatval($result);
	}


	public static function count_ok()
	{
		$result = \lib\db\business_domain\get::count_ok();
		return floatval($result);
	}


	public static function count_pending()
	{
		$result = \lib\db\business_domain\get::count_pending();
		return floatval($result);
	}


	public static function count_failed()
	{
		$result = \lib\db\business_domain\get::count_failed();
		return floatval($result);
	}


	public static function count_action()
	{
		$result = \lib\db\business_domain\get::count_action();
		return floatval($result);
	}


	public static function count_cdn_ok()
	{
		$result = \lib\db\business_domain\get::count_cdn_ok();
		return floatval($result);
	}


	public static function count_cdn_nok()
	{
		$result = \lib\db\business_domain\get::count_cdn_nok();
		return floatval($result);
	}


	public static function count_dns_resolved()
	{
		$result = \lib\db\business_domain\get::count_dns_resolved();
		return floatval($result);
	}


	public static function count_dns_notresolved()
	{
		$result = \lib\db\business_domain\get::count_dns_notresolved();
		return floatval($result);
	}


	public static function count_https_request()
	{
		$result = \lib\db\business_domain\get::count_https_request();
		return floatval($result);
	}


	public static function count_https_request_ok()
	{
		$result = \lib\db\business_domain\get::count_https_request_ok();
		return floatval($result);
	}


	public static function count_all_dns_record()
	{
		$result = \lib\db\business_domain\get::count_all_dns_record();
		return floatval($result);
	}

	public static function count_all_dns_record_status($_status)
	{
		$status = \dash\validate::string_50($_status);
		$result = \lib\db\business_domain\get::count_all_dns_record_status($status);
		return floatval($result);

	}


}
?>