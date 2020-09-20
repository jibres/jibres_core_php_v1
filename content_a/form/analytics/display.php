<?php if(!\dash\data::formDetail_analyze()) {?>
  <div class="welcome">
    <p><?php echo T_("Create now"); ?></p>
    <h2><?php echo T_("Create form view"); ?></h2>

    <div class="buildBtn">
      <a class="btn xl master" data-data='{"create": "create"}' data-confirm ><?php echo T_("Buil it now"); ?></a>
    </div>
  </div>
<?php }else{ ?>
  <div class="welcome">
    <p><?php echo T_("Your analyze was created"); ?></p>
    <h2><?php echo T_("View"); ?></h2>

    <div class="buildBtn">
      <a href="<?php echo \dash\url::that(). '/table?id='. \dash\request::get('id') ?>" ><?php echo T_("View"); ?></a>
    </div>
  </div>
<?php } //endif ?>
