<?php
namespace lib\app\website\footer;

class get
{
	public static function isset_footer($_only_name = false)
	{
		$active_footer = \lib\db\setting\get::platform_cat_key( 'website', 'footer', 'active');
		if(!$active_footer || !isset($active_footer['value']))
		{
			return false;
		}

		if($_only_name)
		{
			return $active_footer['value'];
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

		$active_footer_detail = \lib\app\website\footer\template::get($active_footer['value']);
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

		$contain = \lib\app\website\footer\template::get_contain($active_footer['value']);
		if(!is_array($contain))
		{
			$contain = [];
		}

		$load_saved_detail = [];

		if($contain)
		{
			$load_saved_detail = \lib\db\setting\get::platform_cat_multi_key( 'website', 'footer_customized', $contain);
			if(is_array($load_saved_detail))
			{
				$load_saved_detail = array_column($load_saved_detail, 'value', 'key');
			}
		}

		if(isset($load_saved_detail['footer_logo']) && $load_saved_detail['footer_logo'])
		{
			$load_saved_detail['footer_logo'] = \lib\filepath::fix($load_saved_detail['footer_logo']);
		}

		$active_footer_detail['saved'] = $load_saved_detail;

		return $active_footer_detail;
	}
}
?>
