<?php
$productSettingSaved = \dash\data::productSettingSaved();

$html .= '<h1>'. \dash\data::dataRow_title().'</h1>';
if(\dash\data::dataRow_title2())
{
  $html .= '<h2 class="ltr">'. \dash\data::dataRow_title2().'</h2>';
}
if(\dash\data::dataRow_preparationdatestring())
{
 $html .= '<time title="'. \dash\fit::date(\dash\data::dataRow_preparationdate()).'"><span>'. T_("Estimated Delivery on").'</span> '. \dash\data::dataRow_preparationdatestring(). '</time>';
}

$html .= '<div class="productReviewShort">';
{

  if(\dash\data::customerReview_count())
  {
    $html .= '<div class="starRating inline-block" data-star='. \dash\data::customerReview_avg(). ' data-gold>';
    {
      $html .= '<i></i><i></i><i></i><i></i><i></i>';
    }
    $html .= '</div>';
    $html .= '<div>'. T_(":val out of 5", ['val' => \dash\fit::number(\dash\data::customerReview_avg())]). '</div>';
    $html .= '<div>'. T_(":val Reviews", ['val' => \dash\fit::number(\dash\data::customerReview_count())]). '</div>';
  }
  if(\dash\data::dataRow_stock() > 0)
  {
    $html .= '<div>'. T_(":val Stock", ['val' => \dash\fit::number(\dash\data::dataRow_stock())]). '</div>';
  }
}
$html .= '</div>';

$html .= '<div class="row align-center">';
{
  $html .= '<div class="c">';
  {
    if(\dash\data::dataRow_discount())
    {
     $html .= '<div>';
     {
        $html .= '<span>'. T_("List Price"). '</span>';
        $html .= '<div class="priceShow" data-first>';
        {
          $html .= '<span class="price">'. \dash\fit::price_old(\dash\data::dataRow_price()). '</span>';
        }
        $html .= '</div>';
        $html .= '<div class="priceShow ltr" data-discount title="'. T_("You Save"). ' '. \dash\fit::price_old(round(\dash\data::dataRow_discount())). '">- '. \dash\fit::price_old(\dash\data::dataRow_discountpercent()).' %</div>';
     }
     $html .= '</div>';
    }
    $html .= '<div>';
    {
      if(\dash\data::dataRow_finalprice())
      {
        $html .= '<span>'. T_("Price"). '</span>';
        $html .= '<div class="priceShow" data-final>';
        {
          $html .= '<span class="price">'. \dash\fit::price_old(\dash\data::dataRow_finalprice()). '</span>';
          $html .= '<span class="unit">'. \lib\store::currency().'</span>';
        }
        $html .= '</div>';
      }
      elseif(is_null(\dash\data::dataRow_finalprice()) || (is_null(\dash\data::dataRow_price()) && is_null(\dash\data::dataRow_discount())))
      {
        if(a($productSettingSaved, 'free_button_title') && a($productSettingSaved, 'free_button_link'))
        {

          \dash\data::pawContactUsShopBtn(['title' => a($productSettingSaved, 'free_button_title'), 'link' => a($productSettingSaved, 'free_button_link')]);
          $html .= '<a class="btnBuy" href="'. a($productSettingSaved, 'free_button_link'). '" target="_blank">'. a($productSettingSaved, 'free_button_title'). '</a>';
        }
      }
      elseif((string) \dash\data::dataRow_finalprice() === '0')
      {
        $html .= '<span class="font-bold fc-green">'. T_("Free"). '</span>';
      }
    }
    $html .= '</div>';

    /* --------------- vARIANT CHILD --------------- */

    $child = \dash\data::dataRow_child();
    if($child && is_array($child)){}else{$child = [];}
    $count_child = 0;foreach ($child as $key => $value) {if(a($value, 'parent')) {$count_child++;}}
    if($child && $count_child > 1)
    {
        $html .= '<div>';
        {
         $html .= '<select class="select22 " data-link>';
         {
            $html .= '<option>'. T_("To buy select variants"). '</option>';
            foreach ($child as $key => $value)
            {
              if(!a($value, 'parent'))
              {
                // $html .= '<option value="'. a($value, 'url').'" >';
                // $html .= a($value, 'title').'</option>';
              }
              else
              {
                $html .= '<option value="'. a($value, 'url').'" ';
                if(\dash\data::dataRow_id() == a($value, 'id'))
                {
                  $html .= ' selected ';
                }
                $html .= '>';
                if(a($value, 'optionname1')){$html .=  ' '. a($value, 'optionname1'). " ". a($value, 'optionvalue1'); }
                if(a($value, 'optionname2')){$html .=  ' '. a($value, 'optionname2'). " ". a($value, 'optionvalue2'); }
                if(a($value, 'optionname3')){$html .=  ' '. a($value, 'optionname3'). " ". a($value, 'optionvalue3'); }
                $html .= '</option>';
              }

            }
         }
          $html .= '</select>';
        }
        $html .= '</div>';
    }

    if(!\lib\store::nosale())
    {
      $html .= '<div>';
      {

        if(a(\dash\data::dataRow(), 'allow_shop'))
        {

          if(\dash\data::productInCart())
          {
            $html .= '<div data-option="product-update-cart">';
          }

          $html .= '<form method="post" autocomplete="off" id="formaddcart" ';
          if(\dash\data::productInCart())
          {
           $html .= 'data-patch';
          }
          $html .= ' >';
          {
            $html .= '<input type="hidden" name="product_id" value="'. \dash\data::dataRow_id().'">';

            $select_count = a(\dash\data::dataRow(), 'cart_limit', 'sale_step_list');
            if(is_array($select_count) && count($select_count) === 1 && isset($select_count[0]))
            {
              $html .= '<input type="hidden" name="count" value="'. $select_count[0]. '">';
            }
            else
            {

              $html .= '<div class="productQty">';
              {
                if(a(\dash\data::dataRow(), 'cart_limit', 'sale_step_list'))
                {
                  $html .= '<select class="select22" name="count" data-model="productItem">';
                  {
                    if(\dash\data::productInCart())
                    {
                      if(!in_array(\dash\data::productInCartCount(), a(\dash\data::dataRow(), 'cart_limit', 'sale_step_list')))
                      {
                        $html .= '<option value="'. \dash\data::productInCartCount(). '" selected>'. \dash\fit::number(\dash\data::productInCartCount()). '</option>';
                      }
                      $html .= '<option value="0" ';
                      if(\dash\data::productInCartCount() == '0')
                      {
                        $html .= ' selected';
                      }
                      $html .= ' >';
                      $html .=  T_("Remove");
                      $html .= '</option>';
                    }

                      foreach (a(\dash\data::dataRow(), 'cart_limit', 'sale_step_list') as $item_count)
                      {
                        $html .= '<option value="'. $item_count .'" ';
                        if(\dash\data::productInCartCount() == $item_count)
                        {
                          $html .= ' selected';
                        }
                        $html .= ' >';
                        $html .= \dash\fit::number($item_count);
                        $html .= '</option>';
                      }
                  }
                  $html .= '</select>';
                }
                elseif(a(\dash\data::dataRow(), 'cart_limit', 'sale_step_input'))
                {
                  $html .= '<div class="input">';
                  {
                    $html .= '<input type="text" name="count" value="'. round(floatval(\dash\data::productInCartCount())). '" placeholder="'. T_("Qty"). '" minlength="0" maxlength="4" data-format="pirce">';
                  }
                  $html .= '</div>';
                }
              }
              $html .= '</div>';
            }

            if(\dash\data::productInCart())
            {
              $html .= '<a href="'. \dash\url::kingdom(). '/cart" class="link-primary">'. T_("In cart"). '</a>';
              $html .= '<input type="hidden" name="type" value="update_cart">';
            }
            else
            {
              $html .= '<input type="hidden" name="cart" value="add">';
              $html .= '<button type="submit" class="btnBuy" >'. T_("Add to cart"). '</button>';
            }

          }
          $html .= '</form>';
          if(\dash\data::productInCart()) {
          $html .= '</div>';
          } //data-option div
        }
        else
        {
        // can not shop
            $html .= '<div class="font-bold mTB10">'. a(\dash\data::dataRow(), 'shop_message').'</div>';
        } //endif
      }
      $html .= '</div>';
    }






  }
  $html .= '</div>';

  if(\dash\data::propertyList())
  {
    $html .= '<div class="c-auto c-xs-12">';
    {
      $html .= '<ul class="featureBullets">';
      {
         foreach (\dash\data::propertyList() as $property => $property_detail)
         {
            foreach ($property_detail['list'] as $cat)
            {
              if(a($cat, 'outstanding'))
              {
                $html .= '<li><span>'. a($cat, 'key') . '</span> <span class="font-bold">'. a($cat, 'value'). '</span></li>';
              }
            }
         }
      }
      $html .= '</ul>';
    }
    $html .= '</div>';
  }
}
$html .= '</div>';

if(\dash\data::productSettingSaved_view_text() || (\dash\data::productSettingSaved_button_link() && \dash\data::productSettingSaved_button_title()))
{
  $html .= '<div class="msg globalalert-success">';
  {
    $html .= '<div class="row">';
    {
        $html .= '<div class="c-sm-auto">';
        {
          $html .= '<p>';
          {
            $html .= \dash\data::productSettingSaved_view_text();
          }
          $html .= '</p>';
        }
        $html .= '</div>';
        $html .= '<div class="c-sm"></div>';
        $html .= '<div class="c-sm-auto">';
        {
            if(\dash\data::productSettingSaved_button_link() && \dash\data::productSettingSaved_button_title())
            {
              $html .= '<a class="btn-success" target="_blank" href="'. \dash\data::productSettingSaved_button_link(). '">'. \dash\data::productSettingSaved_button_title(). '</a>';
            }
        }
        $html .= '</div>';
    }
    $html .= '</div>';
  }
  $html .= '</div>';
}

?>