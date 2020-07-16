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
		echo '"';
		if(!\dash\detect\device::detectPWA())
		{
			// $opt = '{"slidesToShow": 4, "slidesToScroll": 3}';
			echo " data-slider='product'";
		}
		echo '>';

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
		$title           = \dash\get::index($_item, 'title');
		$image           = \dash\get::index($_item, 'thumb');
		$price           = \dash\get::index($_item, 'price');
		$discount        = \dash\get::index($_item, 'discount');
		$discountpercent = \dash\get::index($_item, 'discountpercent');
		$unit            = \dash\get::index($_item, 'unit');

		echo '<a class="jProduct1" href="'. \dash\get::index($_item, 'url'). '">';
		{
			echo '<div class= "cover"><img src="'. $image. '" alt="'. $title. '"></div>';
			if($discountpercent)
			{
				echo '<span class="discount">';
				echo '-';
				echo \dash\fit::price($discountpercent);
				echo '%';
				echo '</span>';
			}
			// show title
			{
				echo '<div class="title">';
				echo $title;
				echo '</div>';
			}
			// show price line
			echo '<footer class="f">';
			{
				echo '<span class="unit cauto">';
				echo 'تومان';
				echo $unit;
				echo '</span>';

				echo '<span class="price c">';
				echo \dash\fit::number($price);
				echo '</span>';

				if($discount)
				{
					echo '<del class="compareAtPrice cauto os">';
					echo \dash\fit::number($price + $discount);
					echo '</del>';
				}
			}
			echo '</footer>';

		}
		echo '</a>';
	}


}
?>