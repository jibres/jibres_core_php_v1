<?php

$html = '';

if(\dash\url::isLocal())
{
  $saleQuickAccess = \dash\data::saleQuickAccess();
  if(!is_array($saleQuickAccess))
  {
    $saleQuickAccess = [];
  }

  foreach ($saleQuickAccess as $key => $category)
  {
    $html .= '<div data-kerkere=".showQuirckAccess'. a($category, 'id'). '" data-kerkere-single>';
    {
      $html .= '<div class="btn-primary">';
      {
        $html .= a($category, 'title');
      }
      $html .= '</div>';
    }
    $html .= '</div>';

    $html .= '<div class="showQuirckAccess'. a($category, 'id'). '" data-kerkere-content="hide">';
    {
      $optMagicBox =
      [
          'grid' => true,
      ];

      $args =
      [
          'magicbox_title_position' =>  'inside',
          'coverratio'              =>  '1:1',
          'effect'                  =>  'zoom',
          'image_mask'              =>  'none',
          'height'                  =>  'sm',
          'padding_top'             =>  '2',
          'padding_bottom'          =>  '2',
          'container'               =>  '2xl',
          'magicbox_gap'            =>  'md',
          'coverratio:class'        =>  'aspect-w-1 aspect-h-1',
          'radius:class'            =>  'rounded-lg',
          'padding:class'           =>  'py-2 md:py-3 lg:py-4',
          'padding_top:class'       =>  'pt-2 md:pt-3 lg:pt-4 ',
          'height:style'            =>  'min-height: 25vh;',
          'container:class'         =>  'max-w-screen-2xl w-full px-2 sm:px-4 lg:px-5',
          'magicbox_gap:class'      =>  'gap-1 sm:gap-2 md:gap-4 lg:gap-6',
      ];
      $html .= '<div data-type="g1" class="flex overflow-hidden relative py-2 md:py-3 lg:py-4">';
      {
        $html .= '<div class="m-auto max-w-screen-2xl w-full px-2 sm:px-4 lg:px-5">';
        {
          $html .= '<div class="grid grid-cols-10 gap-1 sm:gap-2 md:gap-4 lg:gap-6">';
          {
            $html .= \content_site\assemble\element\magicbox::html($args, $category['products'], $optMagicBox);
          }
          $html .= '</div>';
        }
        // $html .= '</div>';

      }
      $html .= '</div>';

    }
    $html .= '</div>';
  }
}
echo $html;
?>