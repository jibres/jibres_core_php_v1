<?php
if(isset($dataRow['gallery_array']) && is_array($dataRow['gallery_array']))
{
  echo '<div class="gallery" id="lightgallery">';
  {
    echo '<div class="row">';

    foreach ($dataRow['gallery_array'] as $key => $myUrl)
    {
      if(isset($myUrl['path']))
      {
        $endUrl = substr($myUrl['path'], -4);
        if(in_array($endUrl, ['.jpg', '.png', '.gif', '.webp']))
        {
          echo '<div class="c-xs-12 c-sm-6 c-md-4 c-lg-3 c-xxl-2">';
          {
            echo '<a data-action href="'. $myUrl['path'].'" data-fancybox="productGallery">';
            echo '<img src="'. $myUrl['path']. '" alt="'. \dash\data::dataRow_title(). '">';
            echo '</a>';
          }
          echo '</div>';
        }
      }
    }
    echo '</div>';
  }
  echo '</div>';



  echo '<div class="gallery2">';
  foreach ($dataRow['gallery_array'] as $key => $myUrl)
  {
    if(isset($myUrl['path']))
    {
      $endUrl = substr($myUrl['path'], -4);
      if(in_array($endUrl, ['.mp4']))
      {
        echo '<video controls><source src="'. $myUrl['path']. '" type="video/mp4"></video>';
      }
      elseif(in_array($endUrl, ['.mp3']))
      {
        echo '<audio controls><source src="'. $myUrl['path'] .'" type="audio/mpeg"></audio>';
      }
      elseif(in_array($endUrl, ['.pdf']))
      {
        echo '<a href="'. $myUrl['path'] .'" class="btn lg mT25 primary">'. T_("Download"). ' '. T_("PDF"). '</a>';
      }
    }
  }
  echo '</div>';
}
?>