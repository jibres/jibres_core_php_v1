<?php if(\dash\data::firstInit()) {?>
  <div class="welcome">
    <p><?php echo T_("We make all coding list for you"); ?></p>
    <h2><?php echo T_("Easily Import accounting coding"); ?></h2>
    <div class="buildBtn">
      <a class="btn xl master" data-data='{"first": "init"}' data-confirm ><?php echo T_("Import it now"); ?></a>
    </div>
  </div>
  <?php } //endif ?>