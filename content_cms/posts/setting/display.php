<?php

$type   = \dash\data::dataRow_type();

$myID = '?id='. \dash\request::get('id');

$isPage = ($type === 'page');
$isPost = ($type === 'post');

?>


<section class="f" data-option='cms-post-status'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change status");?></h3>
      <div class="body">
        <p><?php echo T_("You can change your post status");?></p>
      </div>
    </div>
  </div>
  <form method="post" class="c4 s12" data-patch>
    <div class="action">
      <input type="hidden" name="runaction_editstatus" value="1">
      <select name="status" class="select22">
        <option value="draft" <?php if(\dash\data::dataRow_status() === 'draft') { echo 'selected';} ?>><?php echo T_("Draft") ?></option>
        <option value="publish" <?php if(\dash\data::dataRow_status() === 'publish') { echo 'selected';} ?>><?php echo T_("Publish") ?></option>
      </select>
    </div>
  </form>
</section>

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
          <option value="standard" <?php if(\dash\data::dataRow_subtype() == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></option>
          <option value="gallery" <?php if(\dash\data::dataRow_subtype() == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></option>
          <option value="video" <?php if(\dash\data::dataRow_subtype() == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></option>
          <option value="audio" <?php if(\dash\data::dataRow_subtype() == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></option>
        </select>
      </div>
    </form>
  </section>
<?php } // endif ?>

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
  <div class="c4 s12">
    <div class="action">
      <a href="<?php echo \dash\url::this(). '/redirecturl'. $myID; ?>" class="btn master"><?php echo T_("Set post redirect url") ?></a>
    </div>
  </div>
</section>

<?php if($isPost) { ?>
  <section class="f" data-option='cms-post-publishdate'>
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Publish date");?></h3>
        <div class="body">
          <p><?php echo T_("By default, the publish time is saved when you set post status publish, and you can manually change the publication date in this section.");?></p>
        </div>
      </div>
    </div>
    <div class="c4 s12">
      <div class="action">
        <a href="<?php echo \dash\url::this(). '/publishdate'. $myID; ?>" class="btn master"><?php echo T_("Edit publish date") ?></a>
      </div>
    </div>
  </section>

  <section class="f" data-option='cms-post-writer'>
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Change post writer"); ?></h3>
        <div class="body">
          <p><?php echo T_("You can change the author of the post manually");?></p>
        </div>
      </div>
    </div>
    <div class="c4 s12">
      <div class="action">
        <a href="<?php echo \dash\url::this(). '/writer'. $myID; ?>" class="btn master"><?php echo T_("Edit post writer") ?></a>
      </div>
    </div>
  </section>
<?php } // endif ?>