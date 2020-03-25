

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <div class="msg primary2"><?php echo T_("You can change these settings everytime."); ?></div>
      <form method="post" autocomplete="off">

        <p><?php echo T_("You can use barcode scanners to quickly enter products to the cart at checkout."); ?> <?php echo T_("If already you have barcode reader in your store, please tell us to add related fileds into products."); ?></p>
        <div class="switch1 fs12">
         <input type="checkbox" name="barcode" id="barcode"  <?php if(\dash\data::dataRow_barcode()) {echo 'checked';}  ?>>
         <label for="barcode"></label>
         <label for="barcode"><?php echo T_("Have barcode reader?"); ?></label>
        </div>

        <div data-response='barcode' <?php if(\dash\data::dataRow_barcode()) {}else{echo 'data-response-hide';}  ?>>
          <hr class="mB25">
          <p><?php echo T_("If already you have scale with label printer, tell us."); ?> <?php echo T_("We allow you to scan barcode of scale receipt, then we detect product and add them automatically."); ?></p>

          <div class="switch1 fs12">
           <input type="checkbox" name="scale" id="scale"  <?php if(\dash\data::dataRow_scale()) {echo 'checked';}  ?>>
           <label for="scale"></label>
           <label for="scale"><?php echo T_("Have scale with label printer?"); ?></label>
          </div>

        </div>

        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>
