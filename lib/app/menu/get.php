<?php
namespace lib\app\menu;

class get
{

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

		$load = \lib\db\setting\get::by_id($id);
		if(!$load)
		{
			\dash\header::status(404, T_("Menu detail not found"));
		}

		$load = self::ready($load);
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


		return $_data;
	}
}
?>