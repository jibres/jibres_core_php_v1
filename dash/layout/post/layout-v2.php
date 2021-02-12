<?php
$cmsSetting = \lib\app\setting\get::cms_setting();
$subType = \dash\data::dataRow_subtype();
echo '<section class="postBlock" data-type="'. $subType. '">';
{

  echo '<div class="avand-md zero">';
  {
    echo \dash\layout\post\part::header($subType);
    echo \dash\layout\post\part::infoBox();
    echo \dash\layout\post\part::article();
    echo \dash\layout\post\part::gallery();


    // comment
    \dash\layout\post\part::commentBox();
  }



  echo '<div class="box">';







  $myPostSimilar = \dash\app\posts\search::similar_post(\dash\data::dataRow_id());
  if($myPostSimilar)
  {
    echo '<nav class="msg">';
    echo '<h4 class="mB20-f">'. T_("Recommended for you"). '</h4>';
    foreach ($myPostSimilar as $key => $value)
    {
      echo '<a class="block" href="'. a($value, 'link') .'">'. $value['title']. '</a>';
    }
    echo '</nav>';
  }
  echo '</div>';
  echo '</div>';



  // close avand
  echo '</div>';
}

// close post Block
echo '</section>';
?>