<?php

$html .= '<div class="featureImgBlock">';
{
  $html .= '<a class="featureImg" data-fancybox="productGallery" href="'. \dash\data::dataRow_thumb(). '">';
  {
      $html .= '<img src="'. \dash\data::dataRow_thumb().'" alt="'. \dash\data::dataRow_title(). '">';
  }
  $html .= '</a>';
}
$html .= '</div>';

$myGallery = a(\dash\data::dataRow(), 'gallery_array');
if(!is_array($myGallery))
{
  $myGallery = [];
}
if(count($myGallery) > 1)
{
  $html .= "<div class='thumbs'>";
  foreach ($myGallery as $key => $item)
  {
    if($key < 5 && isset($item['path']))
    {
      $html .= '<a href="'. $item['path']. '" data-fancybox="productGallery" class="f justify-center align-center thumb">';
      if ($item['type'] === 'video')
      {
        $html .= '<video><source src="'. $item['path']. '" type="'. $item['mime']. '"></video>';
      }
      else
      {
        $html .= '<img src="'. $item['path']. '" alt="'. \dash\data::dataRow_title().' '.$key. '">';
      }
      $html .= '</a>';
    }
    else
    {
      $html .= '<a data-fancybox="productGallery" class="hide" href="'. $item['path']. '"></a>';
    }
  }
  $html .= "</div>";
}

// @TODO @reza @javad
// if have one item in gallery and this item is not image not show this video (for example) in website
?>