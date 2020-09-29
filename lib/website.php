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

	public static function menu_with_title($_key, $_class = null)
	{
		\lib\app\website\menu\generate::menu_with_title($_key, $_class);
	}


	public static function load_enamd()
	{
		$storeData = \dash\data::store_store_data();
		$enamad = isset($storeData['enamad']) ? $storeData['enamad'] : null;
		if($enamad)
		{
			$explode_enamad = explode('_', $enamad);
			if(isset($explode_enamad[0]) && isset($explode_enamad[1]))
			{
				echo '<a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id='.$explode_enamad[0].'&amp;Code='.$explode_enamad[1].'"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id='.$explode_enamad[0].'&amp;Code='.$explode_enamad[1].'" alt="" style="cursor:pointer" id="'.$explode_enamad[1].'"></a>';
			}

		}
	}


	public static function have_header_menu()
	{
		return \lib\app\website\menu\generate::have_header_menu();
	}


	private static $cart_count = null;
	public static function cart_count()
	{
		if(self::$cart_count === null)
		{
			self::$cart_count = \lib\app\cart\get::my_cart_count();
		}

		return self::$cart_count;
	}


	private static $cart_detail = null;
	private static $cart_summary = null;
	public static function cart_detail()
	{
		if(self::$cart_detail === null)
		{
			self::$cart_detail = \lib\app\cart\search::my_detail();
			self::$cart_summary = \lib\app\cart\search::my_detail_summary(self::$cart_detail);
		}

		return self::$cart_detail;
	}


	public static function cart_summary()
	{
		if(self::$cart_detail === null)
		{
			self::cart_detail();
		}

		return self::$cart_summary;
	}


	public static function cart_total($_full = false)
	{
		if(self::$cart_detail === null)
		{
			self::cart_detail();
		}

		if(isset(self::$cart_summary['total']))
		{
			if($_full)
			{
				return \dash\fit::number(self::$cart_summary['total']). ' '. \lib\store::currency();
			}
			else
			{
				return self::$cart_summary['total'];
			}
		}
		else
		{
			return null;
		}
	}


	public static function my_address_list()
	{
		if(!\dash\user::id())
		{
			return [];
		}

		return \dash\app\address::user_address_list(\dash\user::code());
	}


	public static function product_list($_productList, $_type = 1)
	{
		if($_type === 1)
		{
			\lib\website\product_type1::paint($_productList);
		}
		elseif($_type === 2)
		{
			\lib\website\product_type2::paint($_productList);
		}
		else
		{
			\lib\website\product_type1::paint($_productList);
		}
	}
}
?>