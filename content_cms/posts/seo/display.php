<?php $dataRow = \dash\data::dataRow(); ?>

<div class="box">
  <div class="pad">
    <div class="seoPreview">
      <a target="_blank" href="<?php echo \dash\data::postViewLink(); ?>">
        <cite><?php echo \dash\data::dataRow_link(); ?></cite>
      </a>
      <div class="f">
        <div class="c s12 pLa10">
          <h3><?php echo \dash\data::dataRow_post_title(); ?></h3>
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
      <div class="mB10">
        <label for="seotitle"><?php echo T_("SEO Title"); ?></label>
        <div class="input">
          <input type="text" name="seotitle" id="seotitle"  value="<?php echo a($dataRow,'seotitle'); ?>" maxlength='400'>
        </div>
      </div>
      <div class="mB10">
        <label for='excerpt'><?php echo T_("SEO Description"); ?> <small><?php echo T_("If leave it empty we are generate it automatically"); ?></small></label>
        <textarea class="txt" name="excerpt" id="excerpt" maxlength='300' rows='3' placeholder='<?php echo T_("Excerpt used for social media and search engines"); ?>'><?php if(a($dataRow, 'auto_excerpt')){ echo null;}else{ echo a($dataRow,'excerpt'); }; ?></textarea>
      </div>

      <div class="mB10">
        <div class="txtB mB10"><?php echo T_("Special Address") ?></div>
        <div class="row">
          <div class="c-xs-12 c-sm-6 c-md">
            <div class="radio3">
              <input type="radio" name="specialaddress" value="independence" id="independence"  <?php if(\dash\data::dataRow_specialaddress() === 'independence') {echo 'checked';} ?>>
              <label for="independence"><?php echo T_("Independence") ?></label>
            </div>
          </div>
          <div class="c-xs-12 c-sm-6 c-md">
            <div class="radio3">
              <input type="radio" name="specialaddress" value="special" id="special" <?php if(\dash\data::dataRow_specialaddress() === 'special') {echo 'checked';} ?>>
              <label for="special"><?php echo T_("Special") ?></label>
            </div>
          </div>
          <?php if(\dash\data::dataRow_tags()) {?>
            <div class="c-xs-12 c-sm-6 c-md">
              <div class="radio3">
                <input type="radio" name="specialaddress" value="under_tag" id="under_tag" <?php if(\dash\data::dataRow_specialaddress() === 'under_tag') {echo 'checked';} ?>>
                <label for="under_tag"><?php echo T_("Under tag") ?></label>
              </div>
            </div>
          <?php } //endif ?>
          <?php if(\dash\data::parentList()) {?>
            <div class="c-xs-12 c-sm-6 c-md">
              <div class="radio3">
                <input type="radio" name="specialaddress" value="under_page" id="under_page" <?php if(\dash\data::dataRow_specialaddress() === 'under_page') {echo 'checked';} ?>>
                <label for="under_page"><?php echo T_("Under page") ?></label>
              </div>
            </div>
        <?php } //endif ?>
        </div>
      </div>

      <div class="mT10" data-response='specialaddress' data-response-where-not='independence' <?php if(\dash\data::dataRow_specialaddress() === 'independence') {echo 'data-response-hide';} ?>>
          <label for="seoSlug"><?php echo T_("Url"); ?> <small><?php echo T_("End part of your news url."); ?></small></label>
          <div class="input ltr">
            <input type="text" name="slug" id="seoSlug" placeholder='<?php echo T_("Url"); ?>' value="<?php echo a($dataRow,'slug'); ?>" maxlength='100' minlength="1" pattern=".{1,100}">
          </div>
      </div>

      <div class="mB10" data-response='specialaddress' data-response-where='under_page' <?php if(\dash\data::dataRow_specialaddress() === 'under_page') {}else{ echo 'data-response-hide';} ?>>
        <div class="mB10 font-12">
          <div class="mB10"><?php echo T_("You can set this page as a subset of another page") ?></div>
          <div class="fc-mute"><?php echo T_("Only published page can set as page parent") ?></div>
        </div>
        <div class="mB10">
          <select class="select22" name="parent" id="parent" data-placeholder="<?php echo T_("Choose a post") ?>">
            <option value=""><?php echo T_("Choose a post") ?></option>
            <?php foreach (\dash\data::parentList() as $key => $value) {?>
              <option value="<?php echo a($value, 'id'); ?>" <?php if(\dash\data::dataRow_parent() === a($value, 'id')) {echo 'selected';} ?>><?php echo a($value, 'title') ?></option>
            <?php } //endfor ?>
          </select>
        </div>
      </div>

      <div class="mB10" data-response='specialaddress' data-response-where='under_tag' <?php if(\dash\data::dataRow_specialaddress() === 'under_tag') {}else{ echo 'data-response-hide';} ?>>
        <div class="mB10">
          <label for="tagurl"><?php echo T_("Set post address as sub child of tag") ?></label>
          <select class="select22" name="tagurl" id="tagurl" data-placeholder='<?php echo T_("Select tag") ?>'>
            <option value=""><?php echo T_("Select tag") ?></option>
            <?php foreach (\dash\data::dataRow_tags() as $key => $value) {?>
              <option value="<?php echo $value['term_id'] ?>" <?php if(mb_substr(\dash\data::dataRow_url(), 0, mb_strlen($value['url'])) === $value['url']) { echo 'selected';} ?>><?php echo $value['title']; ?></option>
            <?php } //endif ?>
          </select>
        </div>
      </div>
    </div>
  </div>
</form>

<?php if(\dash\data::seoAnalyze()) { $seoAnalyze = \dash\data::seoAnalyze(); ?>
<div class="box">
  <div class="pad">
    <h6 class="txtB"><?php echo T_("SEO analysis") ?></h6>
    <div class="font-20 mB20">
      <div><?php echo \dash\fit::text(a($seoAnalyze, 'rank')). ' '. T_("%") ?> <?php echo a($seoAnalyze, 'star_html') ?></div>

    </div>
    <?php foreach (a($seoAnalyze, 'list') as $key => $value) {?>
      <a class="checklist fc-black" <?php if(a($value, 'class')) { echo 'data-'. a($value, 'class'); } ?> ><?php echo a($value, 'msg'); ?></a>
    <?php } ?>
  </div>
</div>
<?php } //endif ?>