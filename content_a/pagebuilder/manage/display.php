<?php

$dataRow = a(\dash\data::lineList(), 'post_detail');

\dash\data::dataRow($dataRow);

?>
<?php if(!\dash\data::dataRow_ishomepage()) {?>
<section class="f" data-option='cms-post-seo'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Customize SEO");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
       <a class="btn master" href="<?php echo \dash\url::this(). '/seo'. \dash\request::full_get() ?>"><?php echo T_("Customize SEO") ?></a>
    </div>
  </div>
</section>
<?php } //endif ?>

<?php if(\dash\data::dataRow_ishomepage()) {?>

<section class="f" data-option='cms-post-template'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Choose your website status");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form method="post" class="c4 s12" data-patch>
    <div class="action">
      <input type="hidden" name="runaction_edittemplate" value="1">
       <div>

        <div class="radio1 green">
          <input type="radio" name="template" value="publish" id="templatepublish" <?php if(a(\dash\data::dataRow(), 'meta', 'template') === 'publish' || !a(\dash\data::dataRow(), 'meta', 'template')) {echo 'checked';} ?>>
          <label for="templatepublish"><?php echo T_("Customize page"); ?></label>
        </div>
        <div class="radio1 blue">
          <input type="radio" name="template" value="visitcard" id="templatevisitcard" <?php if(a(\dash\data::dataRow(), 'meta', 'template') === 'visitcard') {echo 'checked';} ?>>
          <label for="templatevisitcard"><?php echo T_("Visit Card website"); ?></label>
        </div>

        <div class="radio1 black">
          <input type="radio" name="template" value="comingsoon" id="templatecomingsoon" <?php if(a(\dash\data::dataRow(), 'meta', 'template') === 'comingsoon') {echo 'checked';} ?>>
          <label for="templatecomingsoon"><?php echo T_("Coming Soon page"); ?></label>
        </div>

      </div>
    </div>
  </form>
</section>

<?php }else{ ?>

<section class="f" data-option='cms-post-status'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change status");?></h3>
      <div class="body">
        <p><?php echo T_("The status of a post determines how Jibres handles that post. For instance, public posts viewable by everyone are assigned the publish status, while drafts are assigned the draft status.");?></p>
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
      </div>
    </div>
  </form>
</section>
<?php } //endif ?>




<?php if(!\dash\data::dataRow_ishomepage()) {?>
<section class="f" data-option='cms-post-set-as-homepage'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set as homepage");?></h3>
      <div class="body">
        <p><?php echo T_("You can set this page as your business home page") ?></p>
        <?php if(\dash\data::dataRow_status() !== 'publish') { ?>
        <div class="msg minimal"><?php echo T_("To set this page as your website homepage publish it first") ?></div>
        <?php } // endif ?>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <?php if(\dash\data::dataRow_status() !== 'publish') { ?>
        <button class="btn disabled"><?php echo T_("Set as homepage"); ?></button>
        <?php }else{ ?>
        <button data-confirm data-data='{"setas": "homepage"}' class="btn master"><?php echo T_("Set as homepage"); ?></button>
        <?php } //endif ?>
    </div>
  </div>
</section>
<?php } //endif ?>



<form method="post" autocomplete="off">
  <section class="f" data-option='cms-post-title'>
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Change Title");?></h3>
        <div class="body">
        </div>
      </div>
    </div>
    <div class="c4 s12">
      <div class="action">
        <input type="hidden" name="runaction_edittitle" value="1">
            <div class="input">
              <input type="text" name="title" id="title" placeholder='<?php echo T_("Enter title here"); ?> *' value="<?php echo a(\dash\data::lineList(), 'post_detail', 'title'); ?>"  <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">
            </div>
      </div>
    </div>
    <footer class="txtRa">
      <button class="btn link"><?php echo T_("Save") ?></button>
    </footer>
  </section>
</form>



<?php if(!\dash\data::dataRow_ishomepage()) {?>
<section class="f" data-option='cms-post-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Remove page");?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <button data-confirm data-data='{"remove": "remove"}' class="btn danger"><?php echo T_("Remove"); ?></button>
    </div>
  </div>
</section>
<?php } //endif ?>
