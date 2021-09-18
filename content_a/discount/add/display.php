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
          $html .= '<input type="radio" name="type" value="percentage" id="type-percentage">';
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

    $html .= '<div class="box">';
    {

      $html .= '<div class="body">';
      {
        $html .= '<h2>'. T_("Value"). '</h2>';
        $html .= '<label for="value">'. T_("Discount value"). '</label>';
        $html .= '<div class="input">';
        {
          $html .= '<input type="text" name="value" value="" placeholder="">';
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
          $html .= '<input type="radio" name="applyto" value="allproduct" id="type-allproduct">';
          $html .= '<label for="type-allproduct">'. T_("All product"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="applyto" value="specialcategory" id="type-specialcategory">';
          $html .= '<label for="type-specialcategory">'. T_("Special category"). '</label>';
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
          $html .= '<input type="radio" name="applyto" value="allproduct" id="type-allproduct">';
          $html .= '<label for="type-allproduct">'. T_("None"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="applyto" value="allproduct" id="type-allproduct">';
          $html .= '<label for="type-allproduct">'. T_("Minimum purchase amount ($)"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="applyto" value="specialcategory" id="type-specialcategory">';
          $html .= '<label for="type-specialcategory">'. T_("Minimum quantity of items"). '</label>';
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
          $html .= '<input type="radio" name="customer" value="everyone" id="type-everyone">';
          $html .= '<label for="type-everyone">'. T_("Everyone"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="customer" value="specialgroup" id="type-specialgroup">';
          $html .= '<label for="type-specialgroup">'. T_("Special group of customers"). '</label>';
        }
        $html .= '</div>';

        $html .= '<div class="radio1">';
        {
          $html .= '<input type="radio" name="customer" value="specialcustomers" id="type-specialcustomers">';
          $html .= '<label for="type-specialcustomers">'. T_("Special customers"). '</label>';
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