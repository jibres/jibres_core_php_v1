<?php
namespace lib;


class pagebuilder
{

	public static function logo()
	{
		$header = \dash\data::currentHeader();

		$logo = a($header, 'detail', 'logourl');

		if($logo)
		{
			return $logo;
		}
		return null;
	}


	public static function menu($_key, $_args = null)
	{
		if(strpos($_key, 'header') !== false)
		{
			$header = \dash\data::currentHeader();
			$menu_id = a($header, 'detail', $_key);
		}
		else
		{
			$footer = \dash\data::currentFooter();
			$menu_id = a($footer, 'detail', $_key);
		}

		if(is_numeric($menu_id))
		{
			return \lib\app\menu\generate2::menu($menu_id, $_args);
		}
		return null;

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
				echo '<a class="cert enamad" referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id='.$explode_enamad[0].'&amp;Code='.$explode_enamad[1].'"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id='.$explode_enamad[0].'&amp;Code='.$explode_enamad[1].'" alt="'. T_("Enamad"). '" id="'.$explode_enamad[1].'"></a>';
			}

		}
	}

	public static function load_samandehi()
	{
		$storeData = \dash\data::store_store_data();
		$samandehi_link1 = isset($storeData['samandehi_link1']) ? $storeData['samandehi_link1'] : null;
		$samandehi_link2 = isset($storeData['samandehi_link2']) ? $storeData['samandehi_link2'] : null;
		if($samandehi_link1 && $samandehi_link2)
		{
			echo '<div class="cert samandehi" id="samandehiCert" data-open="'. $samandehi_link1. '"><img src="'. $samandehi_link2.'" alt="'. T_("Samandehi").'"></div>';
		}
	}




	public static function have_footer_menu()
	{
		return a(\dash\data::currentFooter(), 'detail', 'have_footer_menu');
	}

	public static function have_header_menu()
	{
		return a(\dash\data::currentHeader(), 'detail', 'have_header_menu');
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