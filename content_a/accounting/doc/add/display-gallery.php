<?php 
  $gallery = \dash\data::dataRow_gallery_array();

  if(!is_array($gallery))
  {
    $gallery = [];
  }

  $gallery_capacity    = 10;
  $gallery_is_not_free = false;
  $add_html_form       = false;
  $is_auto_send        = true;
  $no_footer        = true;
  $gallery_array       = $gallery;

  echo '<form method="post" class="print:hidden">';
  {
    echo '<input type="hidden" name="uploaddoc" value="uploaddoc">';
    require_once(root. 'dash/layout/post/admin-gallery-box.php');
  }
  echo '</form>';

?>