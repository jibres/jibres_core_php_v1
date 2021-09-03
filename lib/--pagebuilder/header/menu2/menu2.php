<?php
namespace lib\pagebuilder\header\menu2;


class menu2
{

	public static function input_condition($_args = [])
	{
		$_args['header_menu_2']          = 'string_100';
		$_args['set_menu_header_menu_2'] = 'bit';
		return $_args;
	}



	public static function ready_for_db($_data, $_saved_detail = [])
	{

		$menu2 = [];

		if(isset($_data['set_menu_header_menu_2']) && $_data['set_menu_header_menu_2'])
		{
			$menu2['header_menu_2'] = $_data['header_menu_2'];
		}
		elseif(a($_saved_detail, 'detail', 'header_menu_2'))
		{
			$menu2['header_menu_2'] = a($_saved_detail, 'detail', 'header_menu_2');
		}

		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$_data['detail'] = array_merge($_data['detail'], $menu2);

		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['header_menu_2']);
		unset($_data['set_menu_header_menu_2']);


		return $_data;

	}
}
?>