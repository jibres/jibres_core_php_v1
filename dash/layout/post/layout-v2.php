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

    // similar posts
    echo \dash\layout\post\part::similarPost();

    // comment
    \dash\layout\post\part::commentBox();
  }
  // close avand
  echo '</div>';
}

// close post Block
echo '</section>';
?>