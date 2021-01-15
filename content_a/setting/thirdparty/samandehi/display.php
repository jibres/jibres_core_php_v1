<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box">
      <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/samandehi-banner.jpg" alt='samandehi'>
        <div class="body">
          <div class="msg">
            <p><?php echo T_("Any company or individual that wants to have online website, can acquire the Samandehi certification, which is the official indicator for an approved and trusted online vendor."); ?></p>
          </div>

          <?php if(a($storeData, 'samandehi_link1')) {?>
            <div class="msg success2 minimal"><?php echo T_("Your samandehi detail was saved") ?></div>
            <?php if(a($storeData, 'samandehi_link1')) {?>
              <div class="msg minimal">
                <div class="f">
                  <div class="cauto"><code><?php echo a($storeData, 'samandehi_link1') ?></code></div>
                  <div class="c"></div>
                  <div class="cauto"><?php echo T_("Samandehi Link 1") ?></div>
                </div>
              </div>
            <?php } //endif ?>
            <?php if(a($storeData, 'samandehi_link2')) {?>
              <div class="msg minimal">
                <div class="f">
                  <div class="cauto"><code><?php echo a($storeData, 'samandehi_link2') ?></code></div>
                  <div class="c"></div>
                  <div class="cauto"><?php echo T_("Samandehi Link 2") ?></div>
                </div>
              </div>
            <?php } //endif ?>

          <?php } //endif ?>
          <?php if(!a($storeData, 'samandehi_link1')) {?>

            <label for="isamandehi"><?php echo T_("Samandehi Script"); ?> <span class="fc-red">*</span></label>
            <textarea class="txt ltr txtL" rows="5" name="samandehi" id="isamandehi" <?php \dash\layout\autofocus::html() ?> maxlength='5000' minlength="1"  required placeholder='<?php echo T_("Paste you Samandehi code here") ?>'></textarea>
          <?php } //endif ?>
        </div>
        <footer class="txtRa">
          <?php if(!a($storeData, 'samandehi_link1')) {?>
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
          <?php }else{ ?>
            <button class="btn linkDel" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove samandehi setting") ?></button>
          <?php } //endif ?>
        </footer>
    </div>
  </form>
</div>


