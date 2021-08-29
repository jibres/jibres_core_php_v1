<?php
namespace content_site\assemble\wrench;


class price
{
	public static function simple1($_value)
	{
		$priceEl = '';
		$priceEl .= '<div>';
		{
			$price = \dash\fit::price(a($_value, 'finalprice'));
			$freeText = a($_value, 'free_button_title');
			$freeLink = a($_value, 'free_button_link');

      if($price)
      {
        $priceEl .= '<div class="priceShow" data-final>';
        {
          $priceEl .= '<span class="price">'. \dash\fit::price($price). '</span> ';
          $priceEl .= '<span class="unit">'. \lib\store::currency().'</span>';
        }
        $priceEl .= '</div>';
      }
      elseif((string) $price === '0')
      {
        $priceEl .= '<span class="txtB fc-green">'. T_("Free"). '</span>';
      }
      elseif(is_null($price))
      {
        if($freeText && $freeLink)
        {
          $priceEl .= '<a class="btnBuy" href="'. $freeLink. '" target="_blank">'. $freeText. '</a>';
        }
      }
		}
		$priceEl .= '</div>';

		return $priceEl;
	}


}
?>