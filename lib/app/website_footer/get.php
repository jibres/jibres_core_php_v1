<?php
namespace lib\app\website_footer;

class get
{
	public static function isset_footer()
	{
		$active_footer = \lib\db\setting\get::platform_cat_key('website', 'footer', 'active');
		if(!$active_footer || !isset($active_footer['value']))
		{
			return false;
		}

		return $active_footer;
	}


	public static function active_footer_detail()
	{
		$active_footer = self::isset_footer();
		if(!$active_footer || !isset($active_footer['value']))
		{
			return false;
		}

		$active_footer_detail = \lib\app\website_footer\template::get($active_footer['value']);
		if(!$active_footer_detail)
		{
			return false;
		}

		if(isset($active_footer_detail['key']))
		{
			$footer_key = $active_footer_detail['key'];
		}
		else
		{
			\dash\notif::error(T_("Invalid footer key"));
			return false;
		}

		$contain = \lib\app\website_footer\template::get($active_footer['value'], 'contain');
		if(!is_array($contain))
		{
			$contain = [];
		}

		$load_saved_detail = [];

		if($contain)
		{
			$load_saved_detail = \lib\db\setting\get::platform_cat_multi_key('website', 'footer_customized', $contain);
			if(is_array($load_saved_detail))
			{
				$load_saved_detail = array_column($load_saved_detail, 'value', 'key');
			}
		}


		$step         = [];
		$step['menu'] = [];
		$step['logo'] = [];
		$step['desc'] = [];

		if(in_array('footer_logo', $contain))
		{
			$step['logo'][] = ['title' => T_("Set logo"), 'name' => 'logo'];
		}

		if(in_array('footer_menu_1', $contain))
		{
			$step['menu'][] = ['title' => T_("Set menu #1"), 'name' => 'footer_menu_1'];
		}

		if(in_array('footer_menu_2', $contain))
		{
			$step['menu'][] = ['title' => T_("Set menu #2"), 'name' => 'footer_menu_2'];
		}

		if(in_array('footer_description', $contain))
		{
			$step['desc'][] = ['title' => T_("Set Description"), 'name' => 'footer_description'];
		}
		$active_footer_detail['step'] = $step;
		$active_footer_detail['saved'] = $load_saved_detail;

		return $active_footer_detail;

	}


}
?>
