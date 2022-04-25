<?php
$html = '';

if(\dash\data::haveAnyCategory())
{
  $saleQuickAccess = \dash\data::saleQuickAccess();
  if(is_array($saleQuickAccess))
  {
    $columns = array_column($saleQuickAccess, 'title');

    $html .= '<div class="flex flex-nowrap">';
    {
      $html .= '<nav class="flex-1 grow footerQuickAddProduct">';

      $html .= '<ul class="nav nav-tabs text-xs leading-6 items-end px-2">';
      $oneActive = null;
      foreach ($saleQuickAccess as $key => $category)
      {
        $html .= '<li class="nav-item" data-kerkere=".showQuickAccess-'. a($category, 'id'). '" data-kerkere-single="forceOpen">';
        {
          $isActive = true;
          $html .= '<div class="nav-link';
          if($isActive &&  !$oneActive)
          {
            $html .= ' active';
            $oneActive = true;
          }
          $html .= '">';
          $html .= a($category, 'title');
          $html .= '</div>';
        }
        $html .= '</li>';

      }

      // break
      $html .= '<li class="nav-item grow">';
      $html .= '</li>';

      // setting
      $html .= '<li class="nav-item">';
      {
        $html .= '<a href="'.\dash\url::here().'/category/quickaccess" class="nav-link">';
        $html .= \dash\utility\icon::svg('gear', 'bootstrap', null, 'w-6 h-6');
        $html .= '</a>';
      }
      $html .= '</li>';


      $html .= '<li class="nav-item justify-self-end place-content-end">';
      {
        $html .= '<div class="nav-link active" data-ajaxify data-method="post" data-data=\'{"setkeyboard" : "yes"}\'>';
        $html .= \dash\utility\icon::svg('keyboard', 'bootstrap', null, 'w-6 h-6');
        $html .= '</div>';
      }
      $html .= '</li>';

      $html .= '</ul>';


      $oneActive = null;
      $html .= '<div class="bg-white h-36 p-1 text-xs leading-5 overflow-hidden">';
      foreach ($saleQuickAccess as $key => $category)
      {
        $html .= '<div class="showQuickAccess-'. a($category, 'id'). '"';
        if(!$oneActive)
        {
          $oneActive = true;
          $html .= ' data-kerkere-content="open"';
        }
        else
        {
          $html .= ' data-kerkere-content="hide"';
        }
        $html .= '>';
        {
          $html .= '<div class="overflow-x-auto flex">';
          if(isset($category['products']) && is_array($category['products']))
          {
            // $html .= $key;
            // we have some products
            $myProducts = $category['products'];
            if(!$myProducts)
            {
              $html .= '<div class="alert-secondary">'. T_("There are no products in this category"). '</div>';
            }
            foreach ($myProducts as $key2 => $product)
            {
              // loop to draw one product item
              $id = a($product, 'id');
              $img = a($product, 'thumb');
              $title = a($product, 'title');
              $price = a($product, 'finalprice');
              $currency = a($product, 'currency');
              if($img)
              {
                $html .= '<div class="h-32 w-32 inline-block rounded relative overflow-hidden m-1 cursor-pointer transition shadow-sm hover:shadow-lg"';
                $html .= ' data-quick-addProduct="'. $id .'"';
                $html .= '>';
                {
                  $html .= '<img class="block rounded" src="'. $img. '" alt="'. $title.'">';
                  $html .= '<div class="absolute inset-x-0 bottom-0 overflow-hidden p-2">';
                  if($title)
                  {
                    $html .= '<h4 class="line-clamp-2 text-gray-700 leading-5 mb-1">'. $title. '</h4>';
                  }
                  if($price)
                  {
                    $html .= '<div class="line-clamp-1 text-gray-900">';
                    $html .= "<span class='font-bold text-sm'>". \dash\fit::price($price). "</span>";
                    $html .= ' ';
                    $html .= $currency;
                    $html .= '</div>';

                  }
                  $html .= '</div>';
                }
                $html .= '</div>';
              }
            }
          }
          $html .= '</div>';
        }

        $html .= '</div>';
      }
      $html .= '</div>';
      // close footer box
      $html .= '</nav>';


      $keyboard_visible_class = 'hide';
      $keyboard_status = \lib\app\setting\get::quick_get('sale_page', 'on_screen_kerboard');
      if($keyboard_status === 'yes')
      {
        $keyboard_visible_class = '';
      }

      $html .= '<div id="salePageScreenKeyboard">';
      {
          $html .= \content_a\sale\view::keyboard_html($keyboard_visible_class);
      }
      $html .= '</div>';
      // numpad
    }
    $html .= '</div>';
  }

}
echo $html;
?>