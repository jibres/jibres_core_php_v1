<?php
$storeData = \dash\data::store_store_data();
?>


<div class="f justify-center">
 <div class="c6 s12 pA10">
  <form method="post" autocomplete="off">
    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Set Enamad script code here");?></h2></header>
        <div class="body">
          <?php if(\dash\get::index($storeData, 'enamad')) {?>
            <div class="msg success2 minimal"><?php echo T_("Your enamad detail was saved") ?></div>
            <?php if(\dash\data::enamadID()) {?>
              <div class="msg minimal">
                <div class="f">
                  <div class="cauto"><code><?php echo \dash\data::enamadID() ?></code></div>
                  <div class="c"></div>
                  <div class="cauto"><?php echo T_("Enamad ID") ?></div>
                </div>
              </div>
            <?php } //endif ?>
            <?php if(\dash\data::enamadCode()) {?>
              <div class="msg minimal">
                <div class="f">
                  <div class="cauto"><code><?php echo \dash\data::enamadCode() ?></code></div>
                  <div class="c"></div>
                  <div class="cauto"><?php echo T_("Enamad code") ?></div>
                </div>
              </div>
            <?php } //endif ?>
          <?php } //endif ?>
          <?php if(!\dash\get::index($storeData, 'enamad')) {?>

            <label for="ienamad"><?php echo T_("Enamad code"); ?> <span class="fc-red">*</span></label>
            <textarea class="txt ltr txtL" rows="5" name="enamad" id="ienamad" <?php \dash\layout\autofocus::html() ?> maxlength='5000' minlength="1"  required></textarea>
          <?php } //endif ?>
        </div>
        <footer class="txtRa">
          <?php if(!\dash\get::index($storeData, 'enamad')) {?>
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
          <?php }else{ ?>
            <button class="btn linkDel" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove enamad setting") ?></button>
          <?php } //endif ?>
        </footer>
    </div>
  </form>
 </div>
</div>


