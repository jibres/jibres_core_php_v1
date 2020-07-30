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


	public static function product_list_raw($_productList)
	{
		if(!$_productList || !is_array($_productList))
		{
			return;
		}

		echo '<div class="row padLess">';

		foreach ($_productList as $key => $myProduct)
		{
			echo '<div class="c-xs-6 c-sm-4 c-md-2 ">';
			echo '<div class="productBox">';
			{
				self::product_element_create($myProduct);
			}
			echo '</div>';
			echo '</div>';
		}

		echo '</div>';
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
			if(\dash\detect\device::detectPWA())
			{
				echo '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xl-2">';
			}
			else
			{
				echo '<div>';
			}

			echo '<div class="productBox">';
			{
				self::product_element_create($myProduct);
			}
			echo '</div>';
			echo '</div>';
		}

		echo '</div>';
	}


	private static function product_element_create($_item)
	{
		$id              = \dash\get::index($_item, 'id');
		$title           = \dash\get::index($_item, 'title');
		$image           = \dash\get::index($_item, 'thumb');

		$price           = \dash\fit::number(\dash\get::index($_item, 'finalprice'));
		$discount        = \dash\get::index($_item, 'discount');
		$discountpercent = \dash\get::index($_item, 'discountpercent');
		$compareAtPrice = floatval(\dash\get::index($_item, 'price') + floatval(\dash\get::index($_item, 'discount')));
		$compareAtPrice = \dash\fit::number($compareAtPrice);


		$unit            = \dash\get::index($_item, 'unit');
		$allow_shop      = \dash\get::index($_item, 'allow_shop');
		$currency        = \lib\store::currency();

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

			if($allow_shop)
			{
				echo '<div class="btnAddCart" data-action="'. \dash\url::kingdom(). '/cart" data-ajaxify data-data=\'{"cart": "add", "count": 1, "product_id": "'. $id. '"}\'>+</div>';
			}
			else
			{
				echo '<div class="btnAddCart disabled">+</div>';
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
				echo $currency;
				echo '</span>';

				echo '<span class="price c">';
				echo $price;
				echo '</span>';

				if($discount)
				{
					echo '<del class="compareAtPrice cauto os">';
					echo $compareAtPrice;
					echo '</del>';
				}
			}
			echo '</footer>';

		}
		echo '</a>';
	}
}
?>