<?php
$dataRow = \dash\data::dataRow();

$type   = \dash\data::dataRow_type();

?>
<div class="box">
  <div class="pad">
    <div class="seoPreview">
      <a target="_blank" href="<?php echo \dash\data::dataRow_link(); ?>">
        <cite><?php echo \dash\data::dataRow_link(); ?></cite>
      </a>
      <div class="f">
        <div class="c s12 pLa10">
          <h3><?php echo \dash\data::dataRow_title();  ?> | <?php echo \dash\face::site(); ?></h3>
          <p class="desc"><?php echo a($dataRow,'excerpt'); ?></p>
        </div>
        <div class="cauto os s12">
          <img src="<?php echo \dash\url::siftal(); ?>/images/logo/google.png" alt='<?php echo T_("Google"); ?>'>
        </div>
      </div>
    </div>
  </div>
</div>

<form method="post" autocomplete="off" id="editFormSEO">

  <div class="box">
    <div class="pad">
      <?php if($type === 'page' || $type === 'help') {?>
        <?php if(\dash\data::parentList()) {?>
          <p class="">
            <div class="mB10"><?php echo T_("You can set this page as a subset of another page") ?></div>
            <div class="fc-mute"><?php echo T_("Only published page can set as page parent") ?></div>
          </p>

          <div class="mB10">
            <select class="select22" name="parent" id="parent">
              <option value="0"><?php echo T_("Nothing. Independent page") ?></option>
              <?php foreach (\dash\data::parentList() as $key => $value) {?>
                <option value="<?php echo a($value, 'id'); ?>" <?php if(\dash\data::dataRow_parent() === a($value, 'id')) {echo 'selected';} ?>><?php echo a($value, 'title') ?></option>
              <?php } //endfor ?>
            </select>
          </div>
        <?php } //endif ?>
      <?php } //endif ?>

      <div class="mB10">
        <label for="seoSlug"><?php echo T_("Slug"); ?> <small><?php echo T_("End part of your news url."); ?></small></label>
        <div class="input ltr">
          <input type="text" name="slug" id="seoSlug" placeholder='<?php echo T_("Slug"); ?>' value="<?php echo a($dataRow,'slug'); ?>" maxlength='100' minlength="1" pattern=".{1,100}">
        </div>
      </div>

      <?php if($type === 'post' && \dash\data::dataRow_tags()) {?>
        <div class="mB10">
          <label for="tagurl"><?php echo T_("Set post address as sub child of tag") ?></label>
          <select class="select22" name="tagurl" id="tagurl">
            <option value=""><?php echo T_("Independent") ?></option>
            <?php foreach (\dash\data::dataRow_tags() as $key => $value) {?>
              <option value="<?php echo $value['term_id'] ?>" <?php if(substr(\dash\data::dataRow_url(), 0, mb_strlen($value['url'])) === $value['url']) { echo 'selected';} ?>><?php echo $value['title']; ?></option>
            <?php } //endif ?>
          </select>
        </div>
      <?php } //endif ?>

      <div>
        <label for='excerpt'><?php echo T_("SEO Description"); ?> <small><?php echo T_("If leave it empty we are generate it automatically"); ?></small></label>
        <textarea class="txt" name="excerpt" id="excerpt" maxlength='300' rows='3' placeholder='<?php echo T_("Excerpt used for social media and search engines"); ?>'><?php if(a($dataRow, 'auto_excerpt')){ echo null;}else{ echo a($dataRow,'excerpt'); }; ?></textarea>
      </div>

    </div>
  </div>
</form>