
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <p><?php echo T_("Define shipping method");?></p>

        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" value="<?php echo \dash\data::dataRow_title() ?>">
        </div>

        <label for="desc"><?php echo T_("Description"); ?></label>
        <textarea name="desc" class="txt" rows="3"><?php echo \dash\data::dataRow_desc() ?></textarea>

        <div class="check1">
          <input id="status" type="checkbox" name="status" <?php if(\dash\data::dataRow_status() || !\dash\data::editMode()) {echo 'checked';} ?>>
          <label for="status"><?php echo T_("Enable") ?></label>
        </div>

      </div>
      <footer class="">
          <div class="row">
            <div class="c-auto">
              <?php if(\dash\data::editMode()) {?>
                <a href="<?php echo \dash\url::current() ?>" class="btn-outline-secondary"><?php echo T_("Cancel") ?></a>
              <?php } //endif ?>
            </div>
            <div class="c"></div>
            <div class="c-auto">
              <?php if(\dash\data::editMode()) {?>
                <button  class="btn-primary"><?php echo T_("Edit method"); ?></button>
              <?php }else{ ?>
                <button  class="btn-success"><?php echo T_("Create method"); ?></button>
              <?php } //endif ?>
            </div>
          </div>

      </footer>
    </div>
  </form>

  <?php if(\dash\data::methodList()) {?>
    <?php foreach (\dash\data::methodList() as $key => $value){ ?>
      <div class="box">
        <div class="pad">
          <div class="txtB mB10 fs14">
            <?php echo a($value, 'title') ?>
            <?php if(a($value, 'status')) {?>
              <span class="badge xs success2"><?php echo T_("Enable") ?></span>
            <?php }else{ ?>
              <span class="badge xs"><?php echo T_("Disable") ?></span>
            <?php } //endif ?>
          </div>

          <?php if(a($value, 'desc')) {?><div> <p><?php echo nl2br(a($value, 'desc')) ?> </p> </div><?php } //endif ?>
        </div>
        <footer class="">
          <div class="row">
            <div class="c-auto"><div class="btn-link-danger" data-confirm data-data='{"remove": "remove", "id" : "<?php echo a($value, 'id') ?>"}'><?php echo T_("Remove") ?></div></div>
            <div class="c"></div>
            <div class="c-auto">
              <?php if(\dash\data::editMode() && \dash\request::get('id') == a($value, 'id')) { /*Nothing*/ }else{ ?>
                <a href="<?php echo \dash\url::current(). '?id='. a($value, 'id') ?>" class="btn-outline-primary"><?php echo T_("Edit") ?></a>
              <?php } //endif ?>
            </div>
          </div>

        </footer>

      </div>
    <?php } ?>
  <?php } //endif ?>
</div>