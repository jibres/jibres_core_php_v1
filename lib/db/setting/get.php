<?php
namespace lib\db\setting;


class get
{

	public static function payment()
	{
		$query = "SELECT * FROM setting WHERE setting.cat = 'store_setting' AND setting.key LIKE 'payment_%' ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function splash()
	{
		$query = "SELECT * FROM setting WHERE setting.cat = 'splash' ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_cat_key($_cat, $_key)
	{
		$query = "SELECT * FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_cat_key_all($_cat, $_key)
	{
		$query = "SELECT * FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_cat($_cat)
	{
		$query = "SELECT * FROM setting WHERE setting.cat = '$_cat'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM setting WHERE setting.id = '$_id' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function platform_cat($_platform, $_cat)
	{
		$query = "SELECT * FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function platform($_platform)
	{
		$query = "SELECT * FROM setting WHERE setting.platform = '$_platform'  ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function platform_cat_key($_platform, $_cat, $_key)
	{
		$query = "SELECT * FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function platform_cat_key_like($_platform, $_cat, $_key)
	{
		$query = "SELECT * FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key LIKE '$_key' ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function platform_cat_id($_platform, $_cat, $_id)
	{
		$query = "SELECT * FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.id = '$_id' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function platform_cat_multi_key($_platform, $_cat, $_keys)
	{
		$_keys = implode("','", $_keys);
		$query = "SELECT * FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key IN ('$_keys')";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function application_dowload_page()
	{
		$query = "SELECT * FROM setting WHERE setting.platform = 'android' AND setting.cat = 'setting' AND setting.key IN ('googleplay','cafebazar','myket','downloadtitle','downloaddesc') ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function search_value_by_platform($_value, $_platform)
	{
		$query = "SELECT * FROM setting WHERE setting.platform = '$_platform' AND setting.value = '$_value' ";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>