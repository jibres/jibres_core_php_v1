<?php

$type   = \dash\data::dataRow_type();

$isPage = ($type === 'page');
$isPost = ($type === 'post');

?>



<?php if($isPost) {?>
<section class="f" data-option='cms-post-status'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Theme");?></h3>
      <div class="body">
        <p><?php echo T_("You can change your post status");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
        <input type="hidden" name="runaction_defaultpricelist" value="1">
           <select class="select22" name="subtype">
            <option value=""><?php echo T_("Non") ?></option>
              <option value="standard" <?php if(\dash\data::dataRow_subtype() == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></option>
              <option value="image" <?php if(\dash\data::dataRow_subtype() == 'image') { echo 'selected'; } ?> > <?php echo T_("Image"); ?></option>
              <option value="gallery" <?php if(\dash\data::dataRow_subtype() == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></option>
              <option value="video" <?php if(\dash\data::dataRow_subtype() == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></option>
              <option value="audio" <?php if(\dash\data::dataRow_subtype() == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></option>
          </select>
      </div>
  </form>
</section>
<?php } // endif ?>



<section class="f" data-option='product-setting-default-comment'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Comment");?></h3>
      <div class="body">
        <p><?php echo T_("Is it possible to receive comment from customers for each product?");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_comment" value="1">
        <div class="switch1">
          <input type="checkbox" name="comment" id="comment" <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'comment')) { echo 'checked'; } ?>>
          <label for="comment" data-on="<?php echo T_("Open"); ?>" data-off="<?php echo T_("Lock") ?>"></label>
        </div>
      </div>

  </form>
</section>





<section class="f" data-option='product-setting-default-comment'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Publish date");?></h3>
      <div class="body">
        <p><?php echo T_("Is it possible to receive comment from customers for each product?");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_comment" value="1">
        <div class="input">
          <input type="text" name="publishdate" data-format='date' value="13990101" id="publishdate" <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'comment')) { echo 'checked'; } ?>>
          <button class="addon btn master"><?php echo T_("Save") ?></button>
        </div>
      </div>

  </form>
</section>




<section class="f" data-option='product-setting-default-comment'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Redirect");?></h3>
      <div class="body">
        <p><?php echo T_("Is it possible to receive comment from customers for each product?");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_comment" value="1">
        <div class="input">
          <input type="url" name="comment" data-format='url'  id="comment" <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'comment')) { echo 'checked'; } ?>>
          <button class="addon btn master"><?php echo T_("Save") ?></button>
        </div>
      </div>

  </form>
</section>



<section class="f" data-option='cms-post-status'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change post writer"); ?></h3>
      <div class="body">
        <p><?php echo T_("You can change your post status");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
        <input type="hidden" name="runaction_defaultpricelist" value="1">
        <select name="creator" class="select22">
          <option><?php echo T_("Reza Mohiti") ?></option>
          <?php \dash\data::postAdder([]); ?>
          <?php foreach (\dash\data::postAdder() as $key => $value) {?>
            <option <?php if(\dash\data::dataRow_user_id() == $value['id']) { echo 'selected';}  ?> value="<?php echo $value['id']; ?>">
              <?php echo \dash\get::index($value, 'displayname'); ?> - <?php echo \dash\get::index($value, 'mobile'); ?>
            </option>
          <?php } //endfor ?>
        </select>
      </div>
  </form>
</section>



