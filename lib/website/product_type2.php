<?php
namespace lib\website;


class product_type2
{

	public static function paint($__group_products)
	{
		if(!$__group_products || !is_array($__group_products))
		{
			return;
		}

		echo '<div class="row">';

		foreach ($__group_products as $key => $myProduct)
		{
			echo '<div class="c-xs-6 c-sm-4 c-md-3 c-lg-3 c-xl-2">';
			self::create_element_product_2($myProduct);
			echo '</div>';
		}

		echo '</div>';
	}


	private static function create_element_product_2($_item)
	{
		$id              = a($_item, 'id');
		$title           = a($_item, 'title');
		$image           = a($_item, 'thumb');
		$imageIsDefault  = a($_item, 'thumb_default');


		$price           = \dash\fit::number(a($_item, 'finalprice'));
		$discount        = a($_item, 'discount');
		$discountpercent = a($_item, 'discountpercent');
		$compareAtPrice = a($_item, 'price');
		$compareAtPrice = \dash\fit::number($compareAtPrice);


		$unit            = a($_item, 'unit');
		$allow_shop      = a($_item, 'allow_shop');
		$currency        = \lib\store::currency();

		echo '<a class="jProduct2" href="'. a($_item, 'url'). '">';
		{
			echo '<figure class="overlay"';
			if($imageIsDefault)
			{
				echo ' data-gr="'.rand(1, 20).'"';
			}
			echo ">";
			{
				echo '<img src="'. $image. '" alt="'. $title. '">';

			}
			if($discountpercent)
			{
				echo '<span class="discount">';
				echo '-';
				echo \dash\fit::price_old($discountpercent);
				echo '%';
				echo '</span>';
			}

			if($allow_shop)
			{
				echo '<div class="btnAddCart" rel="nofollow" data-action="'. \dash\url::kingdom(). '/cart" data-ajaxify data-data=\'{"cart": "add", "count": 1, "product_id": "'. $id. '"}\'>+</div>';
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
					if($price)
					{
						echo '<span class="unit cauto">';
						echo $currency;
						echo '</span>';

						echo '<span class="price c">';
						echo $price;
						echo '</span>';
					}

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