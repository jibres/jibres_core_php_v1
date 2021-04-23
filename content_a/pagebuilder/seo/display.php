<?php

$dataRow = a(\dash\data::lineList(), 'post_detail');

\dash\data::dataRow($dataRow);

?>

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
        <textarea class="txt" name="excerpt" id="excerpt" maxlength='300' rows='3' placeholder='<?php echo T_("Excerpt used for social media and search engines"); ?>'><?php if(a($dataRow, 'autoexcerpt')){ echo null;}else{ echo a($dataRow,'excerpt'); }; ?></textarea>
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

        </div>
      </div>

      <div class="mT10" data-response='specialaddress' data-response-where-not='independence' <?php if(\dash\data::dataRow_specialaddress() === 'independence') {echo 'data-response-hide';} ?>>
          <label for="seoSlug"><?php echo T_("Url"); ?> <small><?php echo T_("End part of your news url."); ?></small></label>
          <div class="input ltr">
            <input type="text" name="slug" id="seoSlug" placeholder='<?php echo T_("Url"); ?>' value="<?php echo a($dataRow,'slug'); ?>" maxlength='100' minlength="1" pattern=".{1,100}">
          </div>
      </div>
    </div>
  </div>


<section class="f" data-option='cms-post-cover' id="cmspostcover">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Post cover")?></h3>
      <div class="body">
        <p><?php echo T_("Setting up a post cover helps you to publish your post professionally on social networks. If you do not use this feature, the post thumb image will be used as a cover.") ?></p>
      </div>
    </div>
  </div>

    <div class="action" data-uploader data-name='cover' data-type='cover' data-ratio="1.7"  data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-final='#finalImage'  <?php if(\dash\data::dataRow_cover()) { echo "data-fill";}?>>
      <input type="hidden" name="runaction_setcover" value="1">

      <input type="file" accept="image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(\dash\data::dataRow_cover()) {?><label for="image1"><img id="finalImage" src="<?php echo \dash\data::dataRow_cover() ?>"></label><?php } //endif ?></label>
    </div>

  <footer class="txtRa">
    <div class="f">
      <div class="cauto">
        <a class="link" href="<?php echo \dash\url::kingdom(). '/cms/files/choose?'. \dash\request::build_query(['related' => 'postscover', 'related_id' => \dash\request::get('id'), 'type' => 'image',  'ratio' => '16:9', 'bm' => 'pagebuilder']) ?>"><?php echo T_("Choose from gallery") ?></a>
      </div>
      <div class="c"></div>
      <div class="cauto">
        <?php if(\dash\data::dataRow_cover()) {?>
         <div data-confirm  data-data='{"remove_cover": "remove_cover"}' class="link fc-red"><?php echo T_("Remove post cover") ?></div>
        <?php } //endif ?>
      </div>
    </div>
  </footer>
</section>

  </form>

