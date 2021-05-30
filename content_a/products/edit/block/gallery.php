<?php
  $gallery = \dash\data::productDataRow_gallery_array();

  if(!is_array($gallery))
  {
    $gallery = [];
  }

  $add_html_form = false;

  $add_product_module = \dash\url::child() === 'add';

  if(!$add_product_module && \dash\data::productDataRow_title())
  {
    $product_suggestion        = false;
    $product_suggestion_status = a(\dash\data::productSettingSaved(), 'product_suggestion');
  }

  $is_auto_send  = \dash\url::child() === 'edit';
  $gallery_array = $gallery;

  require_once(root. 'dash/layout/post/admin-gallery-box.php');

    if(false)
    {
  // runaction_product_suggestion
  // product_suggestion
  if(!$add_product_module)
  {
    if(isset($product_suggestion_status) && $product_suggestion_status)
    {
      $kerkere_content = " data-kerkere-content='hide' ";
    }
    else
    {
      $kerkere_content = '';
    }

    echo "<div class='showProductSuggestion' ". $kerkere_content .">";
      echo '<p>'. T_("Load suggest image"). '</p>';
      // if have not product title not suggest product image. for example in add product module
      echo '<div class="row" data-digikala-crawl='.  \dash\data::productDataRow_title(). '></div>';
    echo "</div>";
  }
}

?>
