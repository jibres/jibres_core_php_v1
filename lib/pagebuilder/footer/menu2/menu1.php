<?php
namespace lib\pagebuilder\footer\menu2;


class menu2
{

	public static function input_condition($_args = [])
	{
		$_args['footer_menu_1']          = 'string_100';
		$_args['set_menu_footer_menu_1'] = 'bit';
		return $_args;
	}



	public static function ready_for_db($_data, $_saved_detail = [])
	{

		$menu2 = [];

		if(isset($_data['set_menu_footer_menu_1']) && $_data['set_menu_footer_menu_1'])
		{
			$menu2['footer_menu_1'] = $_data['footer_menu_1'];
		}
		elseif(a($_saved_detail, 'detail', 'footer_menu_1'))
		{
			$menu2['footer_menu_1'] = a($_saved_detail, 'detail', 'footer_menu_1');
		}

		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$_data['detail'] = array_merge($_data['detail'], $menu2);

		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['footer_menu_1']);
		unset($_data['set_menu_footer_menu_1']);


		return $_data;

	}
}
?>