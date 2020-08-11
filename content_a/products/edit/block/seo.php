  <div class="box">
    <header data-kerkere='.seoData' data-kerkere-icon='close' data-kerkere-status="close"><h2><?php echo T_("Customize for SEO"); ?></h2></header>
    <div class="pad">
      <div class="seoPreview">
        <a target="_blank" href="<?php echo \dash\data::productDataRow_url(); ?>">
          <cite><?php echo \dash\data::productDataRow_url(); ?></cite>
        </a>
        <div class="f">
          <div class="c s12 pLa10">
            <h3><?php echo \dash\data::productDataRow_title();  ?> | <?php echo \dash\face::site(); ?></h3>
            <p class="desc"><?php echo \dash\get::index($productDataRow,'seodesc'); ?></p>
          </div>
          <div class="cauto os s12">
            <img src="<?php echo \dash\url::siftal(); ?>/images/logo/google.png" alt='<?php echo T_("Google"); ?>'>
          </div>
        </div>
      </div>
      <div class="seoData" data-kerkere-content='hide'>
        <hr>

        <div>
          <label for="seoSlug"><?php echo T_("Slug"); ?> <small><?php echo T_("End part of your product url."); ?></small></label>
          <div class="input ltr mB10">
            <input type="text" name="slug" id="seoSlug" placeholder='<?php echo T_("Slug"); ?>' value="<?php echo \dash\get::index($productDataRow,'slug'); ?>" maxlength='100' minlength="1" pattern=".{1,100}">
          </div>
        </div>
        <div>
          <label for='seoDesc'><?php echo T_("SEO Description"); ?> <small><?php echo T_("If leave it empty we are generate it automatically"); ?></small></label>
          <textarea class="txt" name="seodesc" id="seoDesc" maxlength='300' rows='3' placeholder='<?php echo T_("Excerpt used for social media and search engines"); ?>'><?php echo \dash\get::index($productDataRow,'seodesc'); ?></textarea>
        </div>
      </div>
    </div>
  </div>