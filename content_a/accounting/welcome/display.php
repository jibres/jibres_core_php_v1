<?php if(\dash\data::addFirstCoding()) {?>
<div class="welcome">
  <p><?php echo T_("We make all coding list for you"); ?></p>
  <h2><?php echo T_("Easily Import accounting coding"); ?></h2>
  <div class="buildBtn">
    <a class="btn xl master" data-data='{"first": "init"}' data-ajaxify ><?php echo T_("Import it now"); ?></a>
  </div>
  <a href="<?php echo \dash\url::this(). '/coding/add' ?>"><?php echo T_("I want to add manually") ?></a>
</div>
<?php }elseif(\dash\data::addFirstYear()) {?>
  <div class="welcome">
  <p><?php echo T_("We make all coding list for you"); ?></p>
  <h2><?php echo T_("Add your accounting year"); ?></h2>
  <div class="buildBtn">
    <a href="<?php echo \dash\url::this(). '/year/add' ?>" class="btn xl master"><?php echo T_("Add Accounting year"); ?></a>
  </div>

</div>
<?php } //endif ?>


