<section class="f">
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Last amount");?></h3>
      <div class="val"><?php echo \dash\fit::text(\dash\get::index(\dash\data::lastCredit(), 'amount'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Balance");?></h3>
      <div class="val"><?php echo \dash\fit::text(\dash\get::index(\dash\data::lastCredit(), 'balance'));?></div>
    </a>
  </div>
</section>
<div class="msg fs14 txtB txtL"><b>Last credit description</b> <?php echo \dash\data::lastCredit_description() ?></div>

<div class="f justify-center">
    <div class="c6 s12 fs12">
<?php if(\dash\data::DomainInfo()) {?>
<samp><?php print_r(\dash\data::DomainInfo()) ?></samp>
<?php }//endif ?>
    </div>
</div>