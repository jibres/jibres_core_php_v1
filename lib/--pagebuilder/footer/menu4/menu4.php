<?php
namespace lib\pagebuilder\footer\menu4;


class menu4
{

	public static function input_condition($_args = [])
	{
		$_args['footer_menu_4']          = 'string_100';
		$_args['set_menu_footer_menu_4'] = 'bit';
		return $_args;
	}



	public static function ready_for_db($_data, $_saved_detail = [])
	{

		$menu4 = [];

		if(isset($_data['set_menu_footer_menu_4']) && $_data['set_menu_footer_menu_4'])
		{
			$menu4['footer_menu_4'] = $_data['footer_menu_4'];
		}
		elseif(a($_saved_detail, 'detail', 'footer_menu_4'))
		{
			$menu4['footer_menu_4'] = a($_saved_detail, 'detail', 'footer_menu_4');
		}

		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$_data['detail'] = array_merge($_data['detail'], $menu4);

		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['footer_menu_4']);
		unset($_data['set_menu_footer_menu_4']);


		return $_data;

	}
}
?>