<?php
namespace lib\app\website\header;

class get
{
	public static function isset_header($_only_name = false)
	{
		$active_header = \lib\db\setting\get::platform_cat_key('website', 'header', 'active');
		if(!$active_header || !isset($active_header['value']))
		{
			return false;
		}

		if($_only_name)
		{
			return $active_header['value'];
		}

		return $active_header;
	}


	public static function active_header_detail()
	{
		$active_header = self::isset_header();
		if(!$active_header || !isset($active_header['value']))
		{
			return false;
		}

		$active_header_detail = \lib\app\website\header\template::get($active_header['value']);
		if(!$active_header_detail)
		{
			return false;
		}

		if(isset($active_header_detail['key']))
		{
			$header_key = $active_header_detail['key'];
		}
		else
		{
			\dash\notif::error(T_("Invalid header key"));
			return false;
		}

		$contain = \lib\app\website\header\template::get_contain($active_header['value']);
		if(!is_array($contain))
		{
			$contain = [];
		}

		$load_saved_detail = [];

		if($contain)
		{
			$load_saved_detail = \lib\db\setting\get::platform_cat_multi_key('website', 'header_customized', $contain);
			if(is_array($load_saved_detail))
			{
				$load_saved_detail = array_column($load_saved_detail, 'value', 'key');
			}
		}

		if(isset($load_saved_detail['header_logo']) && $load_saved_detail['header_logo'])
		{
			$load_saved_detail['header_logo'] = \lib\filepath::fix($load_saved_detail['header_logo']);
		}

		$active_header_detail['saved'] = $load_saved_detail;

		return $active_header_detail;
	}
}
?>
