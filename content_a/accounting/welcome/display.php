<?php if(\dash\data::firstInit()) {?>
  <div class="welcome">
    <p><?php echo T_("We make all coding list for you"); ?></p>
    <h2><?php echo T_("Easily Import accounting coding"); ?></h2>
    <div class="buildBtn">
      <a class="btn xl master" data-data='{"first": "init"}' data-ajaxify ><?php echo T_("Import it now"); ?></a>
    </div>
    <a href="<?php echo \dash\url::this(). '/coding/add' ?>"><?php echo T_("I want to add manually") ?></a>
  </div>
  <?php } //endif ?>