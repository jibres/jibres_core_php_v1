<?php
  $gallery = \dash\data::productDataRow_gallery_array();
  if(!is_array($gallery))
  {
    $gallery = [];
  }
  $add_html_form = false;
  $is_auto_send  = \dash\url::child() === 'edit';
  $gallery_array = $gallery;

  require_once(root. 'dash/layout/post/admin-gallery-box.php');

if(a(\dash\data::productSettingSaved(), 'product_suggestion'))
{
  if(\dash\data::productDataRow_title())
  {
    // if have not product title not suggest product image. for example in add product module
    echo '<div class="row" data-digikala-crawl='.  \dash\data::productDataRow_title(). '></div>';
  }
}
?>
