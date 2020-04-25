<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Review gift detail and publish"); ?></h2></header>

      <div class="body">
        <table class="tbl1 v1">
          <tbody>
              <tr><td><?php echo T_("Gift code"); ?></td><td class="txtL"><code class="link txtB"><?php echo \dash\data::dataRow_code(); ?></code></td></tr>
              <?php if(\dash\data::dataRow_giftpercent()) {?>
                <tr><td><?php echo T_("Gift percent"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_giftpercent()). ' '. T_("%"); ?></td></tr>
              <?php }else{ ?>
                <tr><td><?php echo T_("Gift amount"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_giftamount()); ?> <small><?php echo T_("Toman") ?></small></td></tr>
              <?php }//endif ?>
              <tr><td><?php echo T_("Price floor"); ?></td><td class="txtL"><?php echo \dash\fit::number(\dash\data::dataRow_pricefloor()); ?> <small><?php echo T_("Toman") ?></small></td></tr>
              <tr><td><?php echo T_("Gift max"); ?></td><td class="txtL"><?php if(\dash\data::dataRow_giftmax()) { echo \dash\fit::number(\dash\data::dataRow_giftmax()); ?> <small><?php echo T_("Toman");}else{ echo '-';}?></small></td></tr>

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

      <footer class="f">
        <div class="cauto">
          <a class="btn link" href="<?php echo \dash\url::this(). '/list' ?>"><?php echo T_("Leave draft"); ?></a>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <button class="btn success" name="status" value="enable"><?php echo T_("Publish"); ?></button>
        </div>
      </footer>
    </form>
  </div>
</div>