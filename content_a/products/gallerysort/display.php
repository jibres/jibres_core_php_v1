<?php
  $gallery = \dash\data::productDataRow_gallery_array();
  if(!is_array($gallery))
  {
    $gallery = [];
  }
?>

<div class="msg fs14"><?php echo T_("Select any of the image you want and move them to sort") ?></div>
<form method="post" data-sortable data-willy class="ltr">
<?php foreach ($gallery as $key => $value) {?>
  <div class="roundedBox" data-handle <?php if(\dash\get::index($value, 'type') !== 'image') {echo 'data-gr="'. rand(1, 20). '"'; }  ?>>
    <figure class="overlay" >
    	<input type="hidden" name="sort[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
      <?php if(\dash\get::index($value, 'type') === 'image') {?>
        <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo T_("File :val", ['val' => \dash\fit::number($key)]); ?>" data-gr="3">
      <?php }else{ ?>
        <div class="txtC mT10 txtB">
          <span><?php echo \dash\get::index($value, 'type') ?></span>
        </div>
        <img src="<?php echo \dash\app::static_image_url(); ?>" alt="<?php echo T_("File :val", ['val' => \dash\fit::number($key)]); ?>" data-gr="2">
      <?php } //endif ?>
    </figure>
  </div>
<?php } //endfor ?>
</form>