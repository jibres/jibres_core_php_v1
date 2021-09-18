<?php
$html = '';
$html .= '<div class="max-w-lg m-auto">';
{
  $html .= '<form method="post" autocomplete="off" id="discountadd">';
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
            $html .= '<button class="link-secondary text-xs " for="code">'. T_("Generate code"). '</button>';
          }
          $html .= '</div>';

        }
        $html .= '</div>';
        $html .= '<div class="input ltr">';
        {
          $html .= '<input type="text" name="code" value="" placeholder="'.T_("e.g. SPRINGSALE").'">';
        }
        $html .= '</div>';
        $html .= '<label for="code" class=""><small>'.T_("Customers will enter this discount code at checkout."). '</small></label>';
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
          $html .= '<input type="radio" name="type" value="fixedamount" id="type-fixedamount">';
          $html .= '<label for="type-fixedamount">'. T_("Fixed amount"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="type" value="freeshipping" id="type-freeshipping">';
          $html .= '<label for="type-freeshipping">'. T_("Free shipping"). '</label>';
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
    $html .= '<div data-response="type" data-response-where="percentage|fixedamount">';
    {
      $html .= '<div class="box">';
      {

        $html .= '<div class="body">';
        {
          $html .= '<h2>'. T_("Value"). '</h2>';

          $html .= '<div data-response="type" data-response-where="percentage">';
          {
            $html .= '<label for="value">'. T_("Discount value"). '</label>';
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="value" value="" placeholder="'.T_("%").'">';
            }
            $html .= '</div>';
          }
          $html .= '</div>';

          $html .= '<div data-response="type" data-response-where="fixedamount" data-response-hide>';
          {
            $html .= '<label for="value">'. T_("Discount value"). '</label>';
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="value" value="" placeholder="'. \lib\store::currency().'">';
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
          $html .= '<input type="radio" name="applyto" value="allproduct" id="applyto-allproduct" checked>';
          $html .= '<label for="applyto-allproduct">'. T_("All product"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="applyto" value="specialcategory" id="applyto-specialcategory">';
          $html .= '<label for="applyto-specialcategory">'. T_("Special category"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="applyto" data-response-where="specialcategory" data-response-hide>';
        {
          $html .= '<select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">';
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
          $html .= '<input type="radio" name="minimumrequirements" value="none" id="minimum-none" checked>';
          $html .= '<label for="minimum-none">'. T_("None"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="minimumrequirements" value="amount" id="minimum-amount">';
          $html .= '<label for="minimum-amount">'. T_("Minimum purchase amount :currency", ['currency' => '('.\lib\store::currency().')']). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="minimumrequirements" data-response-where="amount" data-response-hide>';
        {
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="value" value="" placeholder="'. \lib\store::currency().'">';
            }
            $html .= '</div>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="minimumrequirements" value="quantity" id="minimum-quantity">';
          $html .= '<label for="minimum-quantity">'. T_("Minimum quantity of items"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="minimumrequirements" data-response-where="quantity" data-response-hide>';
        {
            $html .= '<div class="input">';
            {
              $html .= '<input type="tel" name="value" value="">';
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
          $html .= '<input type="radio" name="customer" value="specialgroup" id="customer-specialgroup">';
          $html .= '<label for="customer-specialgroup">'. T_("Special group of customers"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="customer" data-response-where="specialgroup" data-response-hide>';
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
          $html .= '<input type="radio" name="customer" value="specialcustomers" id="customer-specialcustomers">';
          $html .= '<label for="customer-specialcustomers">'. T_("Special customers"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div data-response="customer" data-response-where="specialcustomers" data-response-hide>';
        {
          $html .= '<select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple" data-ajax--delay="100" data-ajax--url="'. \dash\url::here(). '/hashtag/api?json=true'.'" data-placeholder="'. T_('Enter your tags and seperate them by comma'). '">';
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

        $html .= '<div class="check1 ">';
        {
          $html .= '<input type="checkbox" name="limit" value="everyone" id="limittotal">';
          $html .= '<label for="limittotal">'. T_("Limit number of times this discount can be used in total"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="check1 ">';
        {
          $html .= '<input type="checkbox" name="limit" value="everyone" id="limittotal">';
          $html .= '<label for="limittotal">'. T_("Limit to one use per customer"). '</label>';
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

        $html .= '<div class="check1 ">';
        {
          $html .= '<input type="checkbox" name="limit" value="everyone" id="limittotal">';
          $html .= '<label for="limittotal">'. T_("Limit number of times this discount can be used in total"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="check1 ">';
        {
          $html .= '<input type="checkbox" name="limit" value="everyone" id="limittotal">';
          $html .= '<label for="limittotal">'. T_("Limit to one use per customer"). '</label>';
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