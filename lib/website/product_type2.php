<?php
namespace lib\website;


class product_type2
{

	public static function paint($_productList)
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
				self::create_element_product_2($myProduct);
			}
			echo '</div>';
			echo '</div>';
		}

		echo '</div>';
	}


	private static function create_element_product_2($_item)
	{
		$id              = \dash\get::index($_item, 'id');
		$title           = \dash\get::index($_item, 'title');
		$image           = \dash\get::index($_item, 'thumb');

		$price           = \dash\fit::number(\dash\get::index($_item, 'finalprice'));
		$discount        = \dash\get::index($_item, 'discount');
		$discountpercent = \dash\get::index($_item, 'discountpercent');
		$compareAtPrice = \dash\get::index($_item, 'price');
		$compareAtPrice = \dash\fit::number($compareAtPrice);


		$unit            = \dash\get::index($_item, 'unit');
		$allow_shop      = \dash\get::index($_item, 'allow_shop');
		$currency        = \lib\store::currency();

		echo '<a class="jProduct2" href="'. \dash\get::index($_item, 'url'). '">';
		{
			echo '<figure class="overlay">';
			{
				echo '<img src="'. $image. '" alt="'. $title. '">';

			}
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

			// show price line
			echo '<footer>';
			{
				// show title
				{
					echo '<figcaption>';
					echo $title;
					echo '</figcaption>';
				}

				echo '<div class="f align-center">';
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
				echo '</div>';

			}
			echo '</footer>';

			echo '</figure>';
		}
		echo '</a>';
	}
}
?>