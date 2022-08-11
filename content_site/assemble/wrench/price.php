<?php
namespace content_site\assemble\wrench;


class price
{
	public static function simple1($_value, $_link = null)
	{
    if(!a($_value, 'finalprice') && !a($_value, 'price'))
    {
      return null;
    }

		$priceEl = '';
		$priceEl .= '<div class="priceLine">';
		{
      $price      = a($_value, 'price');
      $finalprice = a($_value, 'finalprice');
      $discount   = a($_value, 'discount');

      if(!$finalprice)
      {
       $finalprice = a($_value, 'price');
      }

      if($discount)
      {
        $priceTitle = T_("Compare at price");
      }
      else
      {
        $priceTitle = T_("Price");
      }


			$freeText = a($_value, 'free_button_title');
			$freeLink = a($_value, 'free_button_link');

      if($finalprice)
      {
        $priceEl .= '<div class="flex">';
        {
          $priceEl .= '<div class="priceShow grow" data-final title="'. $priceTitle.'">';
          {
            $priceEl .= '<span class="price">'. \dash\fit::price($finalprice). '</span> ';
            $priceEl .= '<span class="unit text-sm">'. \lib\store::currency().'</span>';
          }
          $priceEl .= '</div>';

          if($discount)
          {
            $priceEl .= '<div class="priceShow line-through text-red-600" data-final title="'. T_("Price").'">';
            {
              $priceEl .= '<span class="price">'. \dash\fit::price($price). '</span> ';
              $priceEl .= '<span class="unit text-sm">'. \lib\store::currency().'</span>';
            }
            $priceEl .= '</div>';
          }

        }
        $priceEl .= '</div>';
      }
      elseif((string) $finalprice === '0')
      {
        $priceEl .= '<span class="font-bold fc-green">'. T_("Free"). '</span>';
      }
      elseif(is_null($finalprice))
      {
        if($freeText && $freeLink)
        {
        	if($_link)
        	{
          	$priceEl .= '<a class="btnBuy" href="'. $freeLink. '" target="_blank">'. $freeText. '</a>';
        	}
        	else
        	{
          	$priceEl .= '<span class="btnBuy">'. $freeText. '</span>';
        	}
        }
      }
		}
		$priceEl .= '</div>';

		return $priceEl;
	}


}
?>