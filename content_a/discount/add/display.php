<?php

$dataRow = \dash\data::dataRow();
$currency = \lib\store::currency();


$html = '';
$html .= '<div class="max-w-xl m-auto">';
{
  $html .= '<form method="post" autocomplete="off" id="discountadd" data-patch>';
  {
    /*=====================================
    =            Discount code            =
    =====================================*/
    $html .= '<div class="box">';
    {
      $html .= '<div class="body">';
      {
        $html .= '<div class="flex">';
        {
          $html .= '<div class="flex-1">';
          {
            $html .= '<label for="code">'. T_("Discount code"). '</label>';
          }
          $html .= '</div>';

          $html .= '<div class="">';
          {
            $html .= '<button class="link-secondary text-xs" for="code">'. T_("Generate code"). '</button>';
          }
          $html .= '</div>';

        }
        $html .= '</div>';
        $html .= '<div class="input ltr">';
        {
          $html .= '<input type="text" name="code" value="'.a($dataRow, 'code').'" placeholder="'.T_("e.g. SPRINGSALE").'">';
        }
        $html .= '</div>';
        $html .= '<label for="code" class=""><small>'.T_("Customers will enter this discount code at checkout."). '</small></label>';

        $html .= '<textarea name="desc" class="txt" row="3" placeholder="'.T_("Description").'">'.a($dataRow, 'desc'). '</textarea>';
      }
      $html .= '</div>';
    }
    $html .= '</div>';
    /*=====  End of Discount code  ======*/


    /*=============================
    =            types            =
    =============================*/
    $html .= '<div class="box">';
    {
      $html .= '<div class="body">';
      {
        $html .= '<h2>'. T_("Types"). '</h2>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="type" value="percentage" id="type-percentage" checked>';
          $html .= '<label for="type-percentage">'. T_("Percentage"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="type" value="fixed_amount" id="type-fixed_amount">';
          $html .= '<label for="type-fixed_amount">'. T_("Fixed amount"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="type" value="free_shipping" id="type-free_shipping">';
          $html .= '<label for="type-free_shipping">'. T_("Free shipping"). '</label>';
        }
        $html .= '</div>';
      }
      $html .= '</div>';
    }
    $html .= '</div>';
    /*=====  End of types  ======*/


    /*=============================
    =            value            =
    =============================*/
    $html .= '<div data-response="type" data-response-where="percentage|fixed_amount">';
    {
      $html .= '<div class="box">';
      {

        $html .= '<div class="body">';
        {
          $html .= '<h2>'. T_("Value"). '</h2>';

          $html .= '<div data-response="type" data-response-where="percentage">';
          {
            $html .= '<label for="percentage">'. T_("Discount value"). '</label>';
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="percentage" id="percentage" value="'.a($dataRow,'percentage').'" placeholder="'.T_("%").'">';
            }
            $html .= '</div>';

            $html .= '<label for="maxamount">'. T_("Maximum amount"). '</label>';
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="maxamount" id="maxamount" value="'.a($dataRow, 'maxamount').'" placeholder="'. $currency.'">';
            }
            $html .= '</div>';

          }
          $html .= '</div>';

          $html .= '<div data-response="type" data-response-where="fixed_amount" data-response-hide>';
          {
            $html .= '<label for="fixedamount">'. T_("Discount value"). '</label>';
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="fixedamount" id="fixedamount" value="'.a($dataRow, 'fixedamount').'" placeholder="'. $currency.'">';
            }
            $html .= '</div>';
          }
          $html .= '</div>';
        }
        $html .= '</div>';
      }
      $html .= '</div>';
    }
    $html .= '</div>';
    /*=====  End of value  ======*/


    /*================================
    =            apply to            =
    ================================*/
    $html .= '<div class="box">';
    {

      $html .= '<div class="body">';
      {
        $html .= '<h2>'. T_("Apply to"). '</h2>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="applyto" value="all_products" id="applyto-all_products" checked>';
          $html .= '<label for="applyto-all_products">'. T_("All product"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="applyto" value="special_category" id="applyto-special_category">';
          $html .= '<label for="applyto-special_category">'. T_("Special category"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="applyto" data-response-where="special_category" data-response-hide>';
        {
          $html .= '<select name="product_category[]" id="product_category" class="select22" data-model="tag" multiple="multiple">';
          {
            foreach (\dash\data::listProductTag() as $key => $value)
            {

              $html .= '<option value="'. $value['title']. '" ';
              if(is_array(\dash\data::listSavedCat()) && in_array($value['title'], \dash\data::listSavedCat()))
              {
                $html .= ' selected';
              }
              $html .= '>';
              $html .= $value['title'];
              $html .= '</option>';
            }
          }
          $html .= '</select>';
        }
        $html .= '</div>';


        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="applyto" value="special_products" id="applyto-special_products">';
          $html .= '<label for="applyto-special_products">'. T_("Special category"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="applyto" data-response-where="special_products" data-response-hide>';
        {
           $html .= '<select name="special_products[]" id="special_products" class="select22" data-model="tag" multiple="multiple" data-ajax--delay="100" data-ajax--url="'. \dash\url::kingdom(). '/crm/member/api?json=true'.'" data-placeholder="'. T_('Search in customers'). '">';
            foreach ([] as $key => $value)
            {
              $html .= '<option value="<?php echo $value["title"]; ?>" selected><?php echo $value["title"]; ?></option>';
            }
            $html .= '</select>';
        }
        $html .= '</div>';

      }
      $html .= '</div>';
    }
    $html .= '</div>';
    /*=====  End of apply to  ======*/


    /*============================================
    =            Minimum requirements            =
    ============================================*/
    $html .= '<div class="box">';
    {

      $html .= '<div class="body">';
      {
        $html .= '<h2>'. T_("Minimum requirements"). '</h2>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="minrequirements" value="none" id="minimum-none" checked>';
          $html .= '<label for="minimum-none">'. T_("None"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="minrequirements" value="amount" id="minimum-amount">';
          $html .= '<label for="minimum-amount">'. T_("Minimum purchase amount :currency", ['currency' => '('.$currency.')']). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="minrequirements" data-response-where="amount" data-response-hide>';
        {
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="minpurchase" value="'. a($dataRow, 'minpurchase'). '" placeholder="'. $currency.'">';
            }
            $html .= '</div>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="minrequirements" value="quantity" id="minimum-quantity">';
          $html .= '<label for="minimum-quantity">'. T_("Minimum quantity of items"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="minrequirements" data-response-where="quantity" data-response-hide>';
        {
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="minquantity" value="'. a($dataRow, 'minquantity'). '">';
            }
            $html .= '</div>';
        }
        $html .= '</div>';

      }
      $html .= '</div>';
    }
    $html .= '</div>';
    /*=====  End of Minimum requirements  ======*/



    /*============================================
    =            Customer eligibility            =
    ============================================*/
    $html .= '<div class="box">';
    {

      $html .= '<div class="body">';
      {
        $html .= '<h2>'. T_("Customer eligibility"). '</h2>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="customer" value="everyone" id="customer-everyone" checked>';
          $html .= '<label for="customer-everyone">'. T_("Everyone"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="customer" value="special_customer_group" id="customer-special_customer_group">';
          $html .= '<label for="customer-special_customer_group">'. T_("Special group of customers"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="customer" data-response-where="special_customer_group" data-response-hide>';
        {
          $html .= '<select name="customer_group" id="customer_group" class="select22">';
          {
            $customer_group =
            [
              ['key' => 'all', 'title' => T_("All customer")],
              ['key' => 'notsale', 'title' => T_("Not sale")],
              ['key' => 'havesale', 'title' => T_("Have sale")],
            ];

            foreach ($customer_group as $key => $value)
            {

              $html .= '<option value="'. $value['key']. '" ';
              if(false)
              {
                $html .= ' selected';
              }
              $html .= '>';
              $html .= $value['title'];
              $html .= '</option>';
            }
          }
          $html .= '</select>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="customer" value="special_customer" id="customer-special_customer">';
          $html .= '<label for="customer-special_customer">'. T_("Special customers"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="customer" data-response-where="special_customer" data-response-hide>';
        {
          $html .= '<select name="special_customer[]" id="special_customer" class="select22" data-model="tag" multiple="multiple" data-ajax--delay="100" data-ajax--url="'. \dash\url::kingdom(). '/crm/member/api?json=true'.'" data-placeholder="'. T_('Search in customers'). '">';
            foreach ([] as $key => $value)
            {
              $html .= '<option value="<?php echo $value["title"]; ?>" selected><?php echo $value["title"]; ?></option>';
            }
            $html .= '</select>';
        }
        $html .= '</div>';

      }
      $html .= '</div>';
    }
    $html .= '</div>';
    /*=====  End of Customer eligibility  ======*/


    /*===================================
    =            Usage limit            =
    ===================================*/
    $html .= '<div class="box">';
    {

      $html .= '<div class="body">';
      {
        $html .= '<h2>'. T_("Usage limits"). '</h2>';

        $html .= '<div class="check1">';
        {
          $html .= '<input type="checkbox" name="set_usagetotal"  id="set_usagetotal">';
          $html .= '<label for="set_usagetotal">'. T_("Limit number of times this discount can be used in total"). '</label>';
        }
        $html .= '</div>';


        $html .= '<div data-response="set_usagetotal" data-response-hide>';
        {
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="usagetotal" value="'.a($dataRow, 'usagetotal').'">';
            }
            $html .= '</div>';
        }
        $html .= '</div>';

        $html .= '<div class="check1">';
        {
          $html .= '<input type="checkbox" name="usageperuser"  id="usageperuser">';
          $html .= '<label for="usageperuser">'. T_("Limit to one use per customer"). '</label>';
        }
        $html .= '</div>';

      }
      $html .= '</div>';
    }
    $html .= '</div>';
    /*=====  End of Usage limit  ======*/


    /*===================================
    =            Active date            =
    ===================================*/
    $html .= '<div class="box">';
    {
      $html .= '<div class="body">';
      {
        $html .= '<h2>'. T_("Active date"). '</h2>';

        $html .= '<div class="flex">';
        {
          $html .= '<div class="flex-1">';
          {
            $html .= '<label for="startdate">'. T_("Start date"). '</label>';
            $html .= '<div class="input ltr">';
            {
              $html .= '<input type="text" name="startdate" value="'. a($dataRow, 'startdate'). '" id="startdate" placeholder="'.\dash\fit::date_en(date("Y-m-d")).'" data-format="date">';
            }
            $html .= '</div>';
          }
          $html .= '</div>';
          ;

          $html .= '<div class="flex-1 mr-1 ml-1">';
          {
            $html .= '<label for="starttime">'. T_("Time"). '</label>';
            $html .= '<div class="input ltr">';
            {
              $html .= '<input type="text" name="starttime" value="'. a($dataRow, 'starttime'). '" id="starttime" placeholder="'.date("H:i").'" data-format="time">';
            }
            $html .= '</div>';
          }
          $html .= '</div>';

        }
        $html .= '</div>';

        $html .= '<div class="check1">';
        {
          $html .= '<input type="checkbox" name="setenddate"  id="setenddate">';
          $html .= '<label for="setenddate">'. T_("Set end date"). '</label>';
        }
        $html .= '</div>';


        $html .= '<div data-response="setenddate" data-response-hide>';
        {
          $html .= '<div class="flex">';
          {
            $html .= '<div class="flex-1">';
            {
              $html .= '<label for="enddate">'. T_("End date"). '</label>';
              $html .= '<div class="input ltr">';
              {
                $html .= '<input type="text" name="enddate" value="'. a($dataRow, 'enddate'). '" id="enddate" placeholder="'.\dash\fit::date_en(date("Y-m-d")).'" data-format="date">';
              }
              $html .= '</div>';
            }
            $html .= '</div>';


            $html .= '<div class="flex-1 mr-1 ml-1">';
            {
              $html .= '<label for="endtime">'. T_("Time"). '</label>';
              $html .= '<div class="input ltr">';
              {
                $html .= '<input type="text" name="endtime" value="'. a($dataRow, 'endtime'). '" id="endtime" placeholder="'.date("H:i").'" data-format="time">';
              }
              $html .= '</div>';
            }
            $html .= '</div>';

          }
          $html .= '</div>';
        }
        $html .= '</div>';

      }
      $html .= '</div>';
    }
    $html .= '</div>';
    /*=====  End of Active date  ======*/

  }
  $html .= '</form>';
}
$html .= '</div>';


echo $html;
?>