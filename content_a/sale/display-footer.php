<?php
$html = '';

if(\dash\url::isLocal())
{
  $saleQuickAccess = \dash\data::saleQuickAccess();
  if(is_array($saleQuickAccess))
  {
    $columns = array_column($saleQuickAccess, 'title');

    $html .= '<nav class="footerQuickAddProduct">';

    $html .= '<ul class="nav nav-tabs text-xs leading-8">';
    $oneActive = null;
    foreach ($saleQuickAccess as $key => $category)
    {
      $html .= '<li class="nav-item" data-kerkere=".showQuickAccess-'. a($category, 'id'). '" data-kerkere-single>';
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
    $html .= '</ul>';


    $oneActive = null;
    $html .= '<div class="h-32 m-1 text-xs leading-5">';
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
      $html .= '<div class="flex">';
      if(isset($category['products']) && is_array($category['products']))
      {
        // $html .= $key;
        // we have some products
        $myProducts = $category['products'];
        foreach ($myProducts as $key2 => $product)
        {
          // loop to draw one product item
          $img = a($product, 'thumb');
          $title = a($product, 'title');
          $price = a($product, 'finalprice');
          $currency = a($product, 'currency');
          if($img)
          {
            $html .= '<div class="h-32 w-32 rounded relative overflow-hidden p-1">';
            {
              $html .= '<img class="block rounded" src="'. $img. '" alt="'. $title.'">';
              $html .= '<div class="absolute inset-x-0 bottom-0 overflow-hidden p-2">';
              if($title)
              {
                $html .= '<h4 class="line-clamp-2 text-gray-700">'. $title. '</h4>';
              }
              if($price)
              {
                $html .= '<div class="line-clamp-1 text-gray-900">';
                $html .= "<span class='font-bold text-lg'>". \dash\fit::price($price). "</span>";
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


      // var_dump($category['products']);

      // {
      //   $optMagicBox =
      //   [
      //       'grid' => true,
      //   ];

      //   $args =
      //   [
      //       'magicbox_title_position' =>  'inside',
      //       'coverratio'              =>  '1:1',
      //       'effect'                  =>  'zoom',
      //       'image_mask'              =>  'none',
      //       'height'                  =>  'sm',
      //       'padding_top'             =>  '2',
      //       'padding_bottom'          =>  '2',
      //       'container'               =>  '2xl',
      //       'magicbox_gap'            =>  'md',
      //       'coverratio:class'        =>  'aspect-w-1 aspect-h-1',
      //       'radius:class'            =>  'rounded-lg',
      //       'padding:class'           =>  'py-2 md:py-3 lg:py-4',
      //       'padding_top:class'       =>  'pt-2 md:pt-3 lg:pt-4 ',
      //       'height:style'            =>  'min-height: 25vh;',
      //       'container:class'         =>  'max-w-screen-2xl w-full px-2 sm:px-4 lg:px-5',
      //       'magicbox_gap:class'      =>  'gap-1 sm:gap-2 md:gap-4 lg:gap-6',
      //   ];
      //   $html .= '<div data-type="g1" class="bg-white flex overflow-hidden relative py-2 md:py-3 lg:py-4">';
      //   {
      //     $html .= '<div class="m-auto max-w-screen-2xl w-full px-2 sm:px-4 lg:px-5">';
      //     {
      //       $html .= '<div class="grid grid-cols-10 gap-1 sm:gap-2 md:gap-4 lg:gap-6">';
      //       {
      //         $html .= \content_site\assemble\element\magicbox::html($args, $category['products'], $optMagicBox);
      //       }
      //       $html .= '</div>';
      //     }
      //     $html .= '</div>';

      //   }
      //   $html .= '</div>';

      // }
      $html .= '</div>';
    }
    $html .= '</div>';
    // close footer box
    $html .= '</nav>';
  }

}
echo $html;
?>