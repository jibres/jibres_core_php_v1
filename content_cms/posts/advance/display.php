<?php
$myID = '?id='. \dash\request::get('id');
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
       <div>
        <div class="radio1">
          <input type="radio" name="status" value="draft" id="statusdraft" <?php if(\dash\data::dataRow_status() === 'draft') {echo 'checked';} ?>>
          <label for="statusdraft"><?php echo T_("Draft"); ?></label>
        </div>

        <div class="radio1 green">
          <input type="radio" name="status" value="publish" id="statuspublish" <?php if(\dash\data::dataRow_status() === 'publish') {echo 'checked';} ?>>
          <label for="statuspublish"><?php echo T_("Published"); ?></label>
        </div>
        <?php if(\dash\data::dataRow_status() === 'deleted') {?>
          <div class="radio1 red">
            <input type="radio" name="status" value="deleted" id="statusdeleted" <?php if(\dash\data::dataRow_status() === 'deleted') {echo 'checked';} ?>>
            <label for="statusdeleted"><?php echo T_("Deleted"); ?></label>
          </div>
        <?php } //endif ?>
      </div>
    </div>
  </form>
</section>

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
        <div>
          <div class="radio1">
            <input type="radio" name="subtype" value="standard" id="subtypestandard" <?php if(\dash\data::dataRow_subtype() === 'standard') {echo 'checked';} ?>>
            <label for="subtypestandard"><?php echo T_("Standard"); ?></label>
          </div>
          <div class="radio1">
            <input type="radio" name="subtype" value="gallery" id="subtypegallery" <?php if(\dash\data::dataRow_subtype() === 'gallery') {echo 'checked';} ?>>
            <label for="subtypegallery"><?php echo T_("Gallery"); ?></label>
          </div>
          <div class="radio1">
            <input type="radio" name="subtype" value="video" id="subtypevideo" <?php if(\dash\data::dataRow_subtype() === 'video') {echo 'checked';} ?>>
            <label for="subtypevideo"><?php echo T_("Video"); ?></label>
          </div>
          <div class="radio1">
            <input type="radio" name="subtype" value="audio" id="subtypeaudio" <?php if(\dash\data::dataRow_subtype() === 'audio') {echo 'checked';} ?>>
            <label for="subtypeaudio"><?php echo T_("Audio"); ?></label>
          </div>
        </div>

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
      <div>
        <div class="radio1">
          <input type="radio" name="comment" value="default" id="commentdefault" <?php if(\dash\data::dataRow_comment() === 'default' || !\dash\data::dataRow_comment()) {echo 'checked';} ?>>
          <label for="commentdefault"><?php echo \dash\data::defaultTitleComment(); ?></label>
        </div>
        <div class="radio1 green">
          <input type="radio" name="comment" value="open" id="commentopen" <?php if(\dash\data::dataRow_comment() === 'open') {echo 'checked';} ?>>
          <label for="commentopen"><?php echo T_("Open"); ?></label>
        </div>
        <div class="radio1 red">
          <input type="radio" name="comment" value="closed" id="commentclosed" <?php if(\dash\data::dataRow_comment() === 'closed') {echo 'checked';} ?>>
          <label for="commentclosed"><?php echo T_("Closed"); ?></label>
        </div>
      </div>
    </div>
  </form>
  <footer class="txtRa">
    <a class="btn link" href="<?php echo \dash\url::here(). '/comments?post_id='. \dash\request::get('id'); ?>"><?php echo T_("Show comment") ?></a>
  </footer>
</section>



<section class="f" data-option='cms-post-share'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Smart Share");?></h3>
      <div class="body">
        <p><?php echo T_("Share this post in social networks");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <a href="<?php echo \dash\url::this(). '/share'. $myID; ?>" class="btn master"><?php echo T_("Smart Share") ?></a>
    </div>
  </div>
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


<?php if(!\dash\engine\store::inStore()) {?>
<section class="f" data-option='cms-post-language'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change post language");?></h3>
      <div class="body">
        <p><?php echo T_("You can change your post language");?></p>
      </div>
    </div>
  </div>
  <form method="post" class="c4 s12" data-patch>
    <div class="action">
      <input type="hidden" name="runaction_editlanguage" value="1">
      <select name="language" class="select22">
        <?php foreach (\dash\language::all() as $key => $value) {?>
        <option value="<?php echo $key ?>" <?php if(\dash\data::dataRow_language() === $key) { echo 'selected';} ?>><?php echo a($value, 'localname'); ?></option>
      <?php } //endfor ?>
      </select>
    </div>
  </form>
</section>
<?php } // endif ?>


<section class="f" data-option='cms-post-cover' id="cmspostcover">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Post cover")?></h3>
      <div class="body">
        <p><?php echo T_("Setting up a post cover helps you to publish your post professionally on social networks. If you do not use this feature, the post thumb image will be used as a cover") ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='cover' data-ratio="1.7"  data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-final='#finalImage' data-autoSend <?php if(\dash\data::dataRow_cover()) { echo "data-fill";}?>>
      <input type="hidden" name="runaction_setcover" value="1">

      <input type="file" accept="image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(\dash\data::dataRow_cover()) {?><label for="image1"><img id="finalImage" src="<?php echo \dash\data::dataRow_cover() ?>"></label><?php } //endif ?></label>
    </div>
  </form>

  <footer class="txtRa">
    <div class="f">
      <div class="cauto">
        <a class="btn link" href="<?php echo \dash\url::here(). '/files/choose?'. \dash\request::build_query(['related' => 'postscover', 'related_id' => \dash\request::get('id'), 'type' => 'image',  'ratio' => '16:9']) ?>"><?php echo T_("Choose from gallery") ?></a>
      </div>
      <div class="c"></div>
      <div class="cauto">
        <?php if(\dash\data::dataRow_cover()) {?>
         <div data-confirm data-data='{"remove_cover": "remove_cover"}' class="btn link fc-red"><?php echo T_("Remove post cover") ?></div>
        <?php } //endif ?>
      </div>
    </div>
  </footer>
</section>



<section class="f" data-option='cms-post-remove'>
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Remove post"); ?></h3>
        <div class="body">
        <?php if(\dash\data::dataRow_status() === 'publish') {?>
          <p class="fc-red"><?php echo T_("Can not remove post when published. You must be change your post status to draft and then can remove it.");?></p>
        <?php }else{ ?>
          <p><?php echo T_("Are your sure to remove this post?");?></p>
        <?php } ?>
        </div>
      </div>
    </div>
    <div class="c4 s12">
      <div class="action">
        <?php if(\dash\data::dataRow_status() === 'publish') {?>
          <div class="btn danger disabled"><?php echo T_("Remove Post") ?></div>
        <?php }else{ ?>
          <div class="btn danger" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove Post") ?></div>
        <?php } //endif ?>
      </div>
    </div>
  </section>