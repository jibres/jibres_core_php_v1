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

		$contain = \lib\app\website_header\template::get($active_header['value'], 'contain');
		if(!is_array($contain))
		{
			$contain = [];
		}

		$load_saved_detail = [];

		if($contain)
		{
			$saved_contain = array_map(['self', 'saved_contain'], $contain);
			$load_saved_detail = \lib\db\setting\get::platform_cat_multi_key('website', 'header_customized', $saved_contain);
			if(is_array($load_saved_detail))
			{
				$load_saved_detail = array_column($load_saved_detail, 'value', 'key');
				$remove_saved_from_key = [];
				foreach ($load_saved_detail as $key => $value)
				{
					if(substr($key, 0, 6) === 'saved_')
					{
						$remove_saved_from_key[substr($key, 6)] = $value;
					}


				}

				$load_saved_detail = $remove_saved_from_key;
			}
		}

		if(isset($load_saved_detail['header_logo']) && $load_saved_detail['header_logo'])
		{
			$load_saved_detail['header_logo'] = \lib\filepath::fix($load_saved_detail['header_logo']);
		}


		$step         = [];
		$step['menu'] = [];
		$step['logo'] = [];
		$step['desc'] = [];

		if(in_array('header_logo', $contain))
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
		$active_header_detail['saved'] = $load_saved_detail;

		return $active_header_detail;

	}


	/**
	 * Saved detail in setting table start by 'saved_' string
	 *
	 * @param      <type>  $_data  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function saved_contain($_data)
	{
		if(is_string($_data))
		{
			return 'saved_'. $_data;
		}
		else
		{
			return null;
		}
	}

}
?>
