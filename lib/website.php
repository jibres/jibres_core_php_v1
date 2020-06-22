<?php
namespace lib;


class website
{

	public static function logo()
	{
		$logo = \dash\get::index(\dash\data::website(), 'header', 'header_logo');
		if($logo)
		{
			return \lib\filepath::fix($logo);
		}
		return null;
	}


	public static function menu($_key, $_class = null)
	{
		\lib\app\website\menu\generate::menu($_key, $_class);
	}



	public static function have_header_menu()
	{
		return \lib\app\website\menu\generate::have_header_menu();
	}



	public static function cart_count()
	{
		return \lib\app\cart\get::my_cart_count();
	}
}
?>