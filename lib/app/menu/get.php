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