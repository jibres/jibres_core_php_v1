<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-lg">
  <?php require_once(root. 'content_love/store/storeDetail.php') ?>
  <div class="box">
    <div class="body">
      <h6><?php echo T_("Creator") ?></h6>
      <div class="row">
        <div class="c-xs-2 c-sm-2">
          <img class="w100" src="<?php echo \dash\data::currentCreator_avatar() ?>">
        </div>
        <div class="c-xs-10 c-sm-10"><?php echo \dash\data::currentCreator_displayname() ?> <b><?php echo \dash\data::currentCreator_mobile() ?></b></div>
      </div>
      <hr>
      <h6><?php echo T_("Current owner") ?></h6>
      <div class="row">
        <div class="c-xs-2 c-sm-2">
          <img class="w100" src="<?php echo \dash\data::currentOwner_avatar() ?>">
        </div>
        <div class="c-xs-10 c-sm-10"><?php echo \dash\data::currentOwner_displayname() ?> <b><?php echo \dash\data::currentOwner_mobile() ?></b></div>
      </div>
      <hr>
      <?php if(\dash\data::newOwner()) {?>
      <h6><?php echo T_("New owner") ?></h6>
      <div class="row">
        <div class="c-xs-2 c-sm-2">
          <img class="w100" src="<?php echo \dash\data::newOwner_avatar() ?>">
        </div>
        <div class="c-xs-8 c-sm-8"><?php echo \dash\data::newOwner_displayname() ?> <b><?php echo \dash\data::newOwner_mobile() ?></b></div>
        <div class="c-xs-2 c-sm-2"><a href="<?php echo \dash\url::that(). '?id='. \dash\request::get('id') ?>" class="btn-secondary"><?php echo T_("Cancel") ?></a></div>
      </div>

      <div class="btn danger block mTB10" data-confirm data-data='{"changeowner": "changeowner"}'><?php echo T_("Change owner") ?></div>
      <?php }else{ ?>
        <h6><?php echo T_("Choose new owner") ?></h6>
        <form method="get" action="<?php echo \dash\url::that() ?>" autocomplete="off">
          <input type="hidden" name="id" value="<?php echo \dash\request::get('id'); ?>">
          <div class="input">
            <input type="tel" name="newowner" value="<?php echo \dash\request::get('newowner') ?>">
            <button class="addon btn"><?php echo T_("Check") ?></button>
          </div>

        </form>
      <?php } //endif ?>
    </div>
  </div>
</div>