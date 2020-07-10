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



	public static function product_list($_productList)
	{
		if(!$_productList || !is_array($_productList))
		{
			return;
		}

		echo '<div class="row padLess';
		if(\dash\detect\device::detectPWA())
		{
			echo " horizontalScroll nowrap";
		}
		echo '">';

		foreach ($_productList as $key => $myProduct)
		{
			echo '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xl-2 productBox">';
			{
				self::product_element_create($myProduct);
			}
			echo '</div>';
		}

		echo '</div>';
	}


	private static function product_element_create($_item)
	{
		echo '<a class="jProduct1" href="'. \dash\get::index($_item, 'url'). '">';
		{
			echo '<img src="'. \dash\get::index($_item, 'thumb'). '" alt="'. \dash\get::index($_item, 'title'). '">';
			if(\dash\get::index($_item, 'discountpercent'))
			{
				echo '<span class="discount">';
				echo '-7';
				echo \dash\fit::price(\dash\get::index($_item, 'discountpercent'));
				echo '%';
				echo '</span>';
			}
			echo '<footer>';
			{
				echo '<div class="title">'. \dash\get::index($_item, 'title'). '</div>';
				if(\dash\permission::supervisor())
				{
					if(\dash\get::index($_item, 'discount'))
					{
						echo '<u>'. \dash\fit::price(\dash\get::index($_item, 'price') + \dash\get::index($_item, 'discount')). '</u>';
						echo '<br>';
						echo '<i>'. \dash\fit::text(\dash\get::index($_item, 'discountpercent')) . ' '. T_("%"). '</i>';
					}
				}
				echo '<div class="price"><span>'. \dash\fit::number(\dash\get::index($_item, 'price')). '</span> <span class="unit">'. \dash\get::index($_item, 'unit'). '</span></div>';
			}
			echo '</footer>';

		}
		echo '</a>';
	}


}
?>