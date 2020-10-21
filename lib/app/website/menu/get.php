<?php
namespace lib\app\website\menu;

class get
{

	public static function list_all_menu_keys()
	{
		$get = \lib\db\setting\get::platform_cat('website', 'menu');

		$keys = [];

		if(is_array($get))
		{
			$keys = array_column($get, 'key');
		}

		return $keys;
	}



	public static function usage_list($_key)
	{
		$key = \dash\validate::string_100($_key, false);

		$list = [];

		if($key)
		{
			$list = \lib\db\setting\get::search_value_by_platform($key, 'website');
			if(!$list || !is_array($list))
			{
				$list = [];
			}
		}

		$new_list = [];
		foreach ($list as $key => $value)
		{
			if(isset($value['cat']))
			{
				switch ($value['cat'])
				{
					case 'header_customized':
						$new_list[] = ['title' => T_("Header menu"), 'link' => '/header'];
						break;

					case 'footer_customize':
						$new_list[] = ['title' => T_("Header menu"), 'link' => '/footer'];
						break;

					default:
						$new_list[] = ['title' => $value['cat'], 'link' => '/'];
						break;
				}
			}
		}

		return $new_list;

	}



	public static function list_all_menu()
	{
		$get = \lib\db\setting\get::platform_cat('website', 'menu');
		if(is_array($get))
		{
			$get = array_map(['self', 'ready'], $get);
		}

		return $get;
	}


	public static function load_menu_edit()
	{
		$id = \dash\validate::code(\dash\request::get('id'));
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\header::status(404);
		}

		return self::load_menu_by_id($id);

	}


	public static function load_menu_by_id($_id, $_ready = true)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$load = \lib\db\setting\get::by_id($_id);
		if(!$load)
		{
			\dash\header::status(404, T_("Menu detail not found"));
		}

		// cehck only is menu to load
		if(isset($load['cat']) && $load['cat'] === 'menu')
		{
			// nothing
		}
		else
		{
			\dash\header::status(404, T_("Invalid menu id"));
		}

		if($_ready)
		{
			$load = self::ready($load);
		}
		return $load;
	}


	private static function ready($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result = [];

		if(isset($_data['id']))
		{
			$_data['id'] = \dash\coding::encode($_data['id']);
		}

		if(isset($_data['value']) && is_string($_data['value']))
		{
			$_data['value'] = json_decode($_data['value'], true);

			if(isset($_data['value']['title']))
			{
				$_data['title'] = $_data['value']['title'];
			}

			if(isset($_data['value']['slug']))
			{
				$_data['slug'] = $_data['value']['slug'];
			}

			if(isset($_data['value']['list']))
			{
				$_data['list'] = $_data['value']['list'];
			}
		}

		unset($_data['value']);

		$_data['count_child'] = 0;

		if(isset($_data['list']) && is_array($_data['list']))
		{
			$_data['count_child'] = count($_data['list']);
		}

		return $_data;
	}
}
?>