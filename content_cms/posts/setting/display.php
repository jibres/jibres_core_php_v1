<?php

$type   = \dash\data::dataRow_type();

$isPage = ($type === 'page');
$isPost = ($type === 'post');

?>

<?php if($isPost) { ?>
<section class="f" data-option='cms-post-theme'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Theme");?></h3>
      <div class="body">
        <p><?php echo T_("Templates are used to distinguish between posts. You can use it to categorize content on the site");?></p>
      </div>
    </div>
  </div>
  <form autocomplete="off" class="c4 s12" method="post" data-patch>
      <div class="action">
        <input type="hidden" name="runaction_theme" value="1">
           <select class="select22" name="subtype">
            <option value="0"><?php echo T_("Non") ?></option>
              <option value="standard" <?php if(\dash\data::dataRow_subtype() == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></option>
              <option value="image" <?php if(\dash\data::dataRow_subtype() == 'image') { echo 'selected'; } ?> > <?php echo T_("Image"); ?></option>
              <option value="gallery" <?php if(\dash\data::dataRow_subtype() == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></option>
              <option value="video" <?php if(\dash\data::dataRow_subtype() == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></option>
              <option value="audio" <?php if(\dash\data::dataRow_subtype() == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></option>
          </select>
      </div>
  </form>
</section>


<section class="f" data-option='cms-post-comment'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Comment");?></h3>
      <div class="body">
        <p><?php echo T_("Is it possible to receive comment from customers for this post?");?></p>
      </div>
    </div>
  </div>
  <form autocomplete="off" class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_comment" value="1">
        <div class="switch1">
          <input type="checkbox" name="comment" id="comment" <?php if(\dash\data::dataRow_comment() === 'open') { echo 'checked'; } ?>>
          <label for="comment" data-on="<?php echo T_("Open"); ?>" data-off="<?php echo T_("Lock") ?>"></label>
        </div>
      </div>

  </form>
</section>


<section class="f" data-option='cms-post-redirect'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Redirect");?></h3>
      <div class="body">
        <p><?php echo T_("If you want your post to be moved to a new page after opening, enter the URL of the new page here");?></p>
      </div>
    </div>
  </div>
  <form autocomplete="off" class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_redirect" value="1">
        <div class="input">
          <input type="url" name="redirecturl"  id="redirect" value="<?php echo \dash\get::index(\dash\data::dataRow_meta(), 'redirect'); ?>">
          <button class="addon btn master"><?php echo T_("Save") ?></button>
        </div>
      </div>

  </form>
</section>
<?php } // endif ?>


<section class="f" data-option='cms-post-publishdate'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Publish date");?></h3>
      <div class="body">
        <p><?php echo T_("By default, the publish time is saved when you set post status publish, and you can manually change the publication date in this section.");?></p>
      </div>
    </div>
  </div>
  <form autocomplete="off" class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_publishdate" value="1">
        <div class="f">
          <div class="c s12">
              <div class="input">
                <input type="text" name="publishtime" data-format='time' value="<?php echo date("H:i", strtotime(\dash\data::dataRow_publishdate())); ?>" id="publishdate" >
              </div>
          </div>
          <div class="c s12">
            <div class="input">
                <input type="text" name="publishdate" data-format='date' value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_publishdate())); ?>" id="publishdate" >
                <button class="addon btn master"><?php echo T_("Save") ?></button>
              </div>
          </div>
        </div>
      </div>

  </form>
</section>

<section class="f" data-option='cms-post-writer'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change post writer"); ?></h3>
      <div class="body">
        <p><?php echo T_("You can change the author of the post manually");?></p>
        <?php if(\dash\data::postWriterOld()) {?>
          <div class="mB10"><?php echo T_("Post writed by") ?></div>
          <div class="mB10 txtB"><?php echo \dash\data::postWriterOld_displayname(); ?></div>
          <div><?php echo \dash\fit::mobile(\dash\data::postWriterOld_mobile()); ?></div>

        <?php } //endif ?>
      </div>
    </div>
  </div>
  <form autocomplete="off" class="c4 s12" method="post" data-patch>
      <div class="action">
        <input type="hidden" name="runaction_postwriter" value="1">
        <select name="creator" class="select22">
          <option value="0"><?php echo T_("Change post writer") ?></option>
          <?php foreach (\dash\data::postWriter() as $key => $value) {?>
            <option <?php if(\dash\data::dataRow_user_id() == $value['id']) { echo 'selected';}  ?> value="<?php echo $value['id']; ?>">
              <?php echo \dash\get::index($value, 'displayname'); ?> - <?php echo \dash\fit::text(\dash\get::index($value, 'mobile')); ?>
            </option>
          <?php } //endfor ?>
        </select>
      </div>
  </form>
</section>



