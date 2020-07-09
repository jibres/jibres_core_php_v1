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


	public static function my_address_list()
	{
		if(!\dash\user::id())
		{
			return [];
		}

		return \dash\app\address::user_address_list(\dash\user::code());
	}



	public static function product_list($_data)
	{
		if(!$_data || !is_array($_data))
		{
			return;
		}
		echo '<div class="row padLess ';
		if(\dash\detect\device::detectPWA())
		{
			echo "horizontalScroll nowrap";
		}
		echo '">';

	     foreach ($_data as $key => $value)
	     {
	        echo '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xl-2 productBox">';
	          echo '<a class="jProduct1" href="'. \dash\get::index($value, 'url'). '">';
	            echo '<img src="'. \dash\get::index($value, 'thumb'). '" alt="'. \dash\get::index($value, 'title'). '">';
	            echo '<footer>';
	              echo '<div class="title">'. \dash\get::index($value, 'title'). '</div>';
	              if(\dash\permission::supervisor())
	              {
	                if(\dash\get::index($value, 'discount'))
	                {
	                    echo '<u>'. \dash\fit::price(\dash\get::index($value, 'price') + \dash\get::index($value, 'discount')). '</u>';
	                    echo '<br>';
	                    echo '<i>'. \dash\fit::text(\dash\get::index($value, 'discountpercent')) . ' '. T_("%"). '</i>';
	                }
	              }
	              echo '<div class="price"><span>'. \dash\fit::number(\dash\get::index($value, 'price')). '</span> <span class="unit">'. \dash\get::index($value, 'unit'). '</span></div>';
	            echo '</footer>';
	          echo '</a>';
	        echo '</div>';
	      }
	    echo '</div>';
	}
}
?>