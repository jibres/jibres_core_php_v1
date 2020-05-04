<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 s12">

    <div class="box impact">
      <header><h2><?php echo T_("Gift card detail"); ?></h2></header>
      <div class="body zeroPad">
        <table class="tbl1 v1">
          <tbody>
            <tr><td><?php echo T_("Gift code"); ?></td><td class="txtL"><code class="link txtB"><?php echo \dash\data::dataRow_code(); ?></code></td></tr>
            <?php if(\dash\data::dataRow_giftpercent()) {?>
              <tr><td><?php echo T_("Gift percent"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_giftpercent()). ' '. T_("%"); ?></td></tr>
            <?php }else{ ?>
              <tr><td><?php echo T_("Gift amount"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_giftamount()); ?> <small><?php echo \lib\currency::unit() ?></small></td></tr>
            <?php }//endif ?>
            <tr><td><?php echo T_("Price floor"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_pricefloor()); ?> <small><?php echo \lib\currency::unit() ?></small></td></tr>
            <tr><td><?php echo T_("Gift max"); ?></td><td class="txtL"><?php if(\dash\data::dataRow_giftmax()) { echo \dash\fit::number(\dash\data::dataRow_giftmax()); ?> <small><?php echo \lib\currency::unit();}else{ echo '-';}?></small></td></tr>

            <tr><td><?php echo T_("Expire date"); ?></td><td class="txtL"><?php echo \dash\data::dataRow_dateexpire(); ?> </td></tr>

            <tr><td><?php echo T_("For use in"); ?></td><td class="txtL"><?php echo T_(ucfirst(\dash\data::dataRow_forusein())); ?></td></tr>
            <tr><td><?php echo T_("Gift total usage limit"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_usagetotal()); ?></td></tr>
            <tr><td><?php echo T_("Gift usage limit per user"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_usageperuser()); ?></td></tr>
            <tr><td><?php echo T_("Dedicated for users"); ?></td><td class="txtL"><?php echo \dash\data::dataRow_dedicated_string(); ?></td></tr>

            <tr><td><?php echo T_("Description"); ?></td><td class="txtL"><?php echo \dash\data::dataRow_desc(); ?></td></tr>
            <tr><td><?php echo T_("Success msg"); ?></td><td class="txtL"><?php echo \dash\data::dataRow_msgsuccess(); ?></td></tr>

            <tr><td><?php echo T_("Status"); ?></td><td class="txtL"><?php echo T_(ucfirst(\dash\data::dataRow_status())); ?></td></tr>

            <tr><td><?php echo T_("Physical card?"); ?></td><td class="txtL"><?php if(\dash\data::dataRow_physical()){echo T_("Yes");}else{echo T_("No");} ?></td></tr>
            <tr><td><?php echo T_("Are you want to print this gift card?"); ?></td><td class="txtL"><?php if(\dash\data::dataRow_chap()) {echo T_("Yes");}else{echo T_("No");} ?></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="c6 s12">
     <div class="box impact mLa5">
      <header><h2><?php echo T_("Gift card usage detail"); ?></h2></header>
      <div class="body zeroPad">
        <table class="tbl1 v1">
          <tbody>

            <tr><td><?php echo T_("Total usage"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_totalusage()); ?></td></tr>
            <tr><td><?php echo T_("Total user use this gift card"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_totalusage()); ?></td></tr>
            <tr><td><?php echo T_("First use date"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_totalusage()); ?></td></tr>
            <tr><td><?php echo T_("Last use date"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_totalusage()); ?></td></tr>
            <tr><td></td><td class="txtL"><a href="<?php echo \dash\url::this(). '/usage?gift_id='. \dash\request::get('id'); ?>" class="link btn"><?php echo T_("Show usage list"); ?></a></td></tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>