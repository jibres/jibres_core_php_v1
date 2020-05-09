<section class="f" data-option='website-header-upload-logo'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Your Website Logo")?></h3>
      <div class="body">
        <p><?php
$desc = \dash\get::index($box_detail, 'desc');
if($desc)
{
  echo $desc;
}
else
{
  echo T_("Work on your branding and add your logo. If you are not have logo don not worry, we are use your website title until you prepare your innovative logo. Manage and grow your business online with Jibres.");
}
?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action dropzone">
      <div class="input preview">
        <input type="file" name='logo' accept="image/gif, image/jpeg, image/png" id="logo1" data-preview>
        <label for="logo1">
        <?php if(\dash\get::index($header_detail, 'saved', 'header_logo')) {?>
          <img src="<?php echo \dash\get::index($header_detail, 'saved', 'header_logo') ?>" class='avatar fs20'>
        <?php } //endif ?>
        </label>
      </div>

      <button class="btn success mT10"><?php echo T_("Upload") ?></button>
    </div>
  </form>
</section>
