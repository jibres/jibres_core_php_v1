<section class="f" data-option='website-header-upload-logo'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo \dash\get::index($box_detail, 'title');?></h3>
      <div class="body">
        <p><?php echo \dash\get::index($box_detail, 'desc');?></p>
        <?php if(\dash\get::index($header_detail, 'saved', 'header_logo')) {?>
          <img src="<?php echo \dash\get::index($header_detail, 'saved', 'header_logo') ?>" class='avatar fs20'>
        <?php } //endif ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <div class="f">
        <div class="c12">
          <div class="input">
            <input type="file" name="logo" id="logo">
          </div>
        </div>
        <div class="c12 txtRa">
          <button class="btn success mT10"><?php echo T_("Upload") ?></button>
        </div>
      </div>
    </div>
  </form>
</section>
