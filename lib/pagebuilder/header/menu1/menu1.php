<?php
namespace lib\pagebuilder\header\menu1;


class menu1
{




	public static function input_condition($_args = [])
	{
		$_args['header_menu_1']               = 'string_100';


		return $_args;
	}


	public static function input_required()
	{
		return [];
	}


	public static function input_meta()
	{
		return [];
	}


	public static function ready($_data)
	{


		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$menu1 = [];

		if(array_key_exists('header_menu_1', $_data))
		{
			$menu1['header_menu_1'] = $_data['header_menu_1'];
		}
		elseif(a($_saved_detail, 'detail', 'header_menu_1'))
		{
			$menu1['header_menu_1'] = a($_saved_detail, 'detail', 'header_menu_1');
		}

		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$_data['detail'] = array_merge($_data['detail'], $menu1);

		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['header_menu_1']);

		return $_data;

	}
}
?>