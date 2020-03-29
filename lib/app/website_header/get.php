<?php
namespace lib\app\website_header;

class get
{

	public static function active_header_detail()
	{
		$active_header = \lib\db\setting\get::platform_cat_key('website', 'header', 'active');
		if(!$active_header || !isset($active_header['value']))
		{
			return false;
		}

		$active_header_detail = \lib\app\website_header\template::get($active_header['value']);
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

		$current_detail_setting = \lib\db\setting\get::platform_cat_key('website', $header_key, 'customized');
		$current_detail = [];
		if(isset($current_detail_setting['value']) && is_string($current_detail_setting['value']))
		{
			$current_detail = json_decode($current_detail_setting['value'], true);
			if(!is_array($current_detail))
			{
				$current_detail = [];
			}

			if(isset($current_detail['website_header_logo_setting_id']) && is_numeric($current_detail['website_header_logo_setting_id']))
			{
				$load_logo_detail = \lib\db\setting\get::by_id($current_detail['website_header_logo_setting_id']);
				if(isset($load_logo_detail['value']))
				{
					$current_detail['header_logo_file'] = \lib\filepath::fix($load_logo_detail['value']);
				}
			}
		}


		$contain = \lib\app\website_header\template::get($active_header['value'], 'contain');
		if(!is_array($contain))
		{
			$contain = [];
		}

		$step         = [];
		$step['menu'] = [];
		$step['logo'] = [];
		$step['desc'] = [];

		if(in_array('logo', $contain))
		{
			$step['logo'][] = ['title' => T_("Set logo"), 'name' => 'logo'];
		}

		if(in_array('header_menu_1', $contain))
		{
			$step['menu'][] = ['title' => T_("Set menu #1"), 'name' => 'header_menu_1'];
		}

		if(in_array('header_menu_2', $contain))
		{
			$step['menu'][] = ['title' => T_("Set menu #2"), 'name' => 'header_menu_2'];
		}

		if(in_array('header_description', $contain))
		{
			$step['desc'][] = ['title' => T_("Set Description"), 'name' => 'header_description'];
		}

		$active_header_detail['step'] = $step;
		$active_header_detail['current_detail'] = $current_detail;


		return $active_header_detail;

	}

}
?>
