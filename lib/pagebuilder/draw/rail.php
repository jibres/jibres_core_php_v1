<?php
namespace lib\pagebuilder\draw;


class rail
{

	public static function draw($_args, $_productList)
	{
		if(!$_productList || !is_array($_productList))
		{
			return;
		}
		$html = '';

		$html .= '<div class="row';
		if(\dash\detect\device::detectPWA())
		{
			$html .= " horizontalScroll nowrap";
		}
		$html .= '"';
		if(!\dash\detect\device::detectPWA())
		{
			// $opt = '{"slidesToShow": 4, "slidesToScroll": 3}';
			$html .= " data-slider='product'";
		}
		$html .= '>';

		foreach ($_productList as $key => $myProduct)
		{
			if(\dash\detect\device::detectPWA())
			{
				$html .= '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xl-2">';
			}
			else
			{
				$html .= '<div>';
			}

			$html .= '<div class="productBox">';
			{
				$html .= self::create_element_product_1($myProduct);
			}
			$html .= '</div>';
			$html .= '</div>';
		}

		$html .= '</div>';

		return $html;

	}


	private static function create_element_product_1($_item)
	{
		$id              = a($_item, 'id');
		$title           = a($_item, 'title');
		$image           = a($_item, 'imageurl');
		$imageIsDefault  = a($_item, 'thumb_default');

		$price           = \dash\fit::number(a($_item, 'finalprice'));
		$discount        = a($_item, 'discount');
		$discountpercent = a($_item, 'discountpercent');
		$compareAtPrice = a($_item, 'price');
		$compareAtPrice = \dash\fit::number($compareAtPrice);


		$unit            = a($_item, 'unit');
		$allow_shop      = a($_item, 'allow_shop');
		$currency        = \lib\store::currency();

		$html = '';

		$html .= '<a class="jProduct1" href="'. a($_item, 'url'). '">';
		{
			$html .= '<div class= "cover"';
			if($imageIsDefault)
			{
				$html .= ' data-gr="'.rand(1, 20).'"';
			}
			$html .= ">";
			$html .= '<img src="'. $image. '" alt="'. $title. '">';
			$html .= '</div>';

			if($discountpercent)
			{
				$html .= '<span class="discount">';
				$html .= '-';
				$html .= \dash\fit::price_old($discountpercent);
				$html .= '%';
				$html .= '</span>';
			}

			if($allow_shop)
			{
				$html .= '<div class="btnAddCart" rel="nofollow" data-action="'. \dash\url::kingdom(). '/cart" data-ajaxify data-data=\'{"cart": "add", "count": 1, "product_id": "'. $id. '"}\'>+</div>';
			}
			// show title
			{
				$html .= '<div class="title">';
				$html .= $title;
				$html .= '</div>';
			}

			if($allow_shop)
			{

				// show price line
				$html .= '<footer class="f">';
				{
						$html .= '<span class="unit cauto">';

						if($price)
						{
							$html .= $currency;
						}

						$html .= '</span>';

						$html .= '<span class="price c">';
						$html .= $price;
						$html .= '</span>';

					if($discount)
					{
						$html .= '<del class="compareAtPrice cauto os">';
						$html .= $compareAtPrice;
						$html .= '</del>';
					}
				}
				$html .= '</footer>';
			}

		}
		$html .= '</a>';

		return $html;
	}
}
?>