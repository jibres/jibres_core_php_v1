<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<div class="avand-md">

   <form method="get" autocomplete="off" action="<?php echo \dash\url::current() ?>">
    <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
    <div class="box">
      <header><h2><?php echo T_("Connect to another business") ?></h2></header>
      <div class="body">
        <p><?php echo T_("You can change business of this domain maually") ?></p>

        <?php if(\dash\data::dataRow_store_id()) {?>
          <div class="alert-info"><?php echo T_("Current business") ?></div>
            <div class="alert2 row">
              <code class="c-auto"><?php echo \dash\data::storeDetail_id(); ?></code>
              <div class="c"></div>

            </div>
            <div class="alert2">
              <span><?php echo T_("Buinsess title") ?></span>
              <a href="<?php echo \dash\url::kingdom(). '/'. \dash\store_coding::encode(\dash\data::storeDetail_id()) ?>"><?php echo \dash\data::storeDetail_title(); ?></a>
            </div>
            <div class="alert2">
              <span><?php echo T_("Owner detail") ?></span>
              <a href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. \dash\data::ownerDetail_id() ?>"><?php echo \dash\data::ownerDetail_displayname() ?></a>
            </div>
        <?php } // endif ?>
        <div>
          <div class="alert-success"><?php echo T_("New business") ?></div>
        <?php if(!\dash\request::get('nbi')) {?>
          <div class="input">
            <input type="tel" name="nbi" placeholder="1000XXX" maxlength="7" value="<?php echo \dash\request::get('nbi') ?>">
          </div>
        <?php } //endif ?>

        <?php if(\dash\request::get('nbi')) {?>

            <div class="alert2 row">
              <code class="c-auto"><?php echo \dash\data::newStoreDetail_id(); ?></code>
              <div class="c"></div>

            </div>
            <div class="alert2">
              <span><?php echo T_("Buinsess title") ?></span>
              <a href="<?php echo \dash\url::kingdom(). '/'. \dash\store_coding::encode(\dash\data::newStoreDetail_id()) ?>"><?php echo \dash\data::newStoreDetail_title(); ?></a>
            </div>
            <div class="alert2">
              <span><?php echo T_("Owner detail") ?></span>
              <a href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. \dash\data::newOwnerDetail_id() ?>"><?php echo \dash\data::newOwnerDetail_displayname() ?></a>
            </div>
        <?php } // endif ?>



        </div>
      </div>
      <footer class="txtRa">
        <?php if(\dash\request::get('nbi')) {?>
          <div data-confirm data-data='{"changebusiness": "changebusiness"}' class="btn-danger"><?php echo T_("Change business") ?></div>
          <a href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id') ?>"  class="btn-secondary"><?php echo T_("Cancel") ?></a>
        <?php }else{ ?>
          <button class="btn-primary"><?php echo T_("Check") ?></button>
        <?php }//endif ?>

      </footer>
    </div>
  </form>


</div>
