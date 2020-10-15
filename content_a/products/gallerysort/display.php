<?php
  $gallery = \dash\data::productDataRow_gallery_array();
  if(!is_array($gallery))
  {
    $gallery = [];
  }
?>

<div class="msg fs14"><?php echo T_("Select any of the image you want and move them to sort") ?></div>
<form method="post" data-sortable  data-willy class="ltr">
<?php foreach ($gallery as $key => $value) {?>
  <div class="roundedBox" data-handle>
    <figure class="overlay" >
    	<input type="hidden" name="sort[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
      <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo T_("File :val", ['val' => \dash\fit::number($key)]); ?>" data-gr="3">
    </figure>
  </div>
<?php } //endfor ?>
</form>