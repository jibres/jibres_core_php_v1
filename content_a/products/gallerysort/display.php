<?php
  $gallery = \dash\data::productDataRow_gallery_array();
  if(!is_array($gallery))
  {
    $gallery = [];
  }

  require_once(root. 'content_a/products/productName.php');
?>

<div class="msg fs14"><?php echo T_("Select any of the image you want and move them to sort") ?></div>
<form method="post" data-sortable data-willy class="ltr">
<?php foreach ($gallery as $key => $value) {?>
  <div class="roundedBox sortHandle" data-handle <?php if(a($value, 'type') !== 'image') {echo 'data-gr="'. rand(1, 20). '"'; }  ?>>
    <figure class="overlay" >
      <input type="hidden" name="sort[]" value="<?php if(a($value, 'id')) { echo $value['id'];}else{ echo a($value, 'path');} ?>">
      <?php if(a($value, 'type') === 'image') {?>
        <img src="<?php echo a($value, 'path'); ?>" alt="<?php echo T_("File :val", ['val' => \dash\fit::number($key)]); ?>" data-gr="3">
      <?php }else{ ?>
        <div class="text-center mt-2 font-bold">
          <span><?php echo a($value, 'type') ?></span>
        </div>
        <img src="<?php echo \dash\app::static_image_url(); ?>" alt="<?php echo T_("File :val", ['val' => \dash\fit::number($key)]); ?>" data-gr="2">
      <?php } //endif ?>
    </figure>
  </div>
<?php } //endfor ?>
</form>