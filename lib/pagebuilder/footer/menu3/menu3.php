<?php
namespace lib\pagebuilder\footer\menu3;


class menu3
{

	public static function input_condition($_args = [])
	{
		$_args['footer_menu_3']          = 'string_100';
		$_args['set_menu_footer_menu_3'] = 'bit';
		return $_args;
	}



	public static function ready_for_db($_data, $_saved_detail = [])
	{

		$menu3 = [];

		if(isset($_data['set_menu_footer_menu_3']) && $_data['set_menu_footer_menu_3'])
		{
			$menu3['footer_menu_3'] = $_data['footer_menu_3'];
		}
		elseif(a($_saved_detail, 'detail', 'footer_menu_3'))
		{
			$menu3['footer_menu_3'] = a($_saved_detail, 'detail', 'footer_menu_3');
		}

		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$_data['detail'] = array_merge($_data['detail'], $menu3);

		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['footer_menu_3']);
		unset($_data['set_menu_footer_menu_3']);


		return $_data;

	}
}
?>