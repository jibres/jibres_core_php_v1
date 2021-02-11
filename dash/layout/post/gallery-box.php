<?php
if(isset($dataRow['gallery_array']) && is_array($dataRow['gallery_array']))
{
  echo '<div class="gallery" id="lightgallery">';
  foreach ($dataRow['gallery_array'] as $key => $myUrl)
  {
    if(isset($myUrl['path']))
    {
      $endUrl = substr($myUrl['path'], -4);
      if(in_array($endUrl, ['.jpg', '.png', '.gif']))
      {
        echo '<a data-action href="'. $myUrl['path'].'"><img src="'. $myUrl['path']. '" alt="'. \dash\data::dataRow_title(). '"></a>';
      }
    }
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