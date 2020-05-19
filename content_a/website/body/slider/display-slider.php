<div class="avand">

  <div class="large f">
    <?php if(\dash\data::lineSetting_slider() && is_array(\dash\data::lineSetting_slider())) {?>
      <?php foreach (\dash\data::lineSetting_slider() as $key => $value) {?>
        <div class="vcard mA10 <?php if(\dash\request::get('index') == $key) {echo 'active';} ?>">
          <img  src="<?php echo \dash\get::index($value, 'image') ?>" alt="<?php echo \dash\get::index($value, 'alt') ?>" >
          <div class="content">
            <div class="header"><?php echo \dash\get::index($value, 'url'); ?></div>
            <div class="meta"><span><?php if(\dash\get::index($value, 'target')) {?><i class="sf-external-link"></i><?php }// endif ?></span></div>
          </div>
          <div class="footer">
            <a href="<?php echo \dash\url::that(). '/slider/edit?id='. \dash\request::get('id'). '&index='. $key; ?>" class="btn primary outline block"><?php echo T_("Edit") ?></a>
          </div>
        </div>
      <?php } // endfor ?>
    <?php } //endif ?>
    <div class="vcard mA10">
      <img  src="<?php echo \dash\url::icon() ?>" alt="<?php echo T_("Add slider page") ?>" >
      <div class="content">
        <div class="header"><?php echo T_("Add new slider page"); ?></div>
      </div>
      <div class="footer">
        <a href="<?php echo \dash\url::that(). '/slider/add?id='. \dash\request::get('id'); ?>" class="btn primary outline block"><?php echo T_("Add") ?></a>
      </div>
    </div>

  </div>
</div>