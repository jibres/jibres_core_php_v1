<?php foreach ($box_detail as $key => $boxValue) {?>
  <section class="f" data-option='website-header-upload-logo-<?php echo $key; ?>'>
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Set menu");?></h3>
        <div class="body">
          <p><?php echo T_("Set website header menu.");?></p>
        </div>
      </div>
    </div>
    <form class="c4 s12" method="post" data-patch>
      <div class="action">
        <div>
          <label for="idmenu<?php echo \dash\get::index($boxValue, 'name'); ?>"><?php echo \dash\get::index($boxValue, 'title'); ?></label>
          <select name="<?php echo \dash\get::index($boxValue, 'name'); ?>" id="idmenu<?php echo \dash\get::index($boxValue, 'name'); ?>" class="select22">
            <?php if(\dash\get::index($header_detail, 'saved', \dash\get::index($boxValue, 'name'))) {?>
              <option value="0"><?php echo T_("Without menu"); ?></option>
            <?php }else{ ?>
              <option></option>
            <?php } //endif ?>
            <?php foreach (\dash\data::allMenu() as $key => $value) {?>
              <option value="<?php echo \dash\get::index($value, 'key'); ?>" <?php if(\dash\get::index($header_detail, 'saved', \dash\get::index($boxValue, 'name')) == \dash\get::index($value, 'key')) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
            <?php } //endfor ?>
          </select>
        </div>
      </div>
    </form>
  </section>
  <?php } //endfor ?>