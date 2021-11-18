<?php require_once(root. 'content_cms/posts/postDetail.php'); ?>
<?php
  $gallery = \dash\data::dataRow_gallery_array();
  if(!is_array($gallery))
  {
    $gallery = [];
  }
?>

<div class="msg fs14"><?php echo T_("Select any of the image you want and move them to sort") ?></div>
<form method="post" data-sortable data-willy class="ltr">
<?php foreach ($gallery as $key => $value) {?>
  <div class="roundedBox sortHandle" data-handle <?php if(a($value, 'type') !== 'image') {echo 'data-gr="'. rand(1, 20). '"'; }  ?>>
    <figure class="overlay" >
      <input type="hidden" name="sort[]" value="<?php echo a($value, 'id'); ?>">
      <?php if(a($value, 'type') === 'image') {?>
        <img src="<?php echo \dash\fit::img(a($value, 'path'), 220); ?>" alt="<?php echo T_("File :val", ['val' => \dash\fit::number($key)]); ?>" data-gr="3">
      <?php }else{ ?>
        <div class="text-center mTB5 txtB"><?php echo T_(ucfirst(a($value, 'type'))) ?></div>
        <img src="<?php echo \dash\fit::img(\dash\app::static_image_url('wide'), 220); ?>" alt="<?php echo T_("File :val", ['val' => \dash\fit::number($key)]); ?>" data-gr="2">
      <?php } //endif ?>
    </figure>
  </div>
<?php } //endfor ?>
</form>