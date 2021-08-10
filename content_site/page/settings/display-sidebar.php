<?php
$currentPageDetail = \dash\data::currentPageDetail();
$coverUrl = a($currentPageDetail, 'cover');


?>
<form method="post" autocomplete="off" data-patch>
	<input type="hidden" name="set_title" value="1">
	<label for="pagetitle"><?php echo T_("Page title") ?></label>
	<div class="input">
		<input type="text" name="title" value="<?php echo a($currentPageDetail, 'title'); ?>" id="<?php echo T_("Page title") ?>">
	</div>
</form>


 <form method="post" autocomplete="off">
    <div class="action" data-uploader data-name='cover' <?php echo \dash\data::ratioHtml() ?> data-final='#finalImageThumb' data-autoSend <?php if($coverUrl) { echo "data-fill";}?> data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-type='featureImage'>
      <input type="hidden" name="runaction_setthumb" value="1">
      <input type="file" accept="image/jpeg, image/png" id="image1thumb">
      <label for="image1thumb"><?php echo T_("Post cover") ?></label>
      <?php if($coverUrl) {?>
      	<label for="image1thumb"><img src="<?php echo \dash\fit::img($coverUrl, 460) ?>" alt="<?php echo T_("Featured image"); ?>" id="finalImageThumb"></label>
		<span class="imageDel" data-confirm data-data='{"remove_cover" : "remove_cover"}'></span>
      <?php } //endif ?>
    </div>
  </form>