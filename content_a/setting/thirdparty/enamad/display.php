<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box">
      <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/enamad-banner.png" alt='enamad'>
        <div class="body">
          <div class="alert2">
            <p><?php echo T_("Any company or individual that wants to sell their products or services online via its own website, should acquire the eNAMAD, which is the official indicator for an approved and trusted online vendor. To secure an eNAMAD certificate, E-commerce Development Center of Iran requires businesses to meet 38 different conditions."); ?></p>
          </div>
          <hr>
          <div class="alert2">
            <p><?php echo T_("To verify your website choose verify by static file in enamad website and set the file name here"); ?></p>
            <div class="input ltr">
              <input type="text" name="enamad_static_file" value="<?php echo \dash\data::enamadStaticFile() ?>">
            </div>
          </div>


          <?php if(a($storeData, 'enamad')) {?>
            <div class="alert-success minimal"><?php echo T_("Your enamad detail was saved") ?></div>
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
          <?php if(!a($storeData, 'enamad')) {?>

            <label for="ienamad"><?php echo T_("Enamad code"); ?> <span class="fc-red">*</span></label>
            <textarea class="txt ltr text-left" rows="5" name="html" id="ienamad" <?php \dash\layout\autofocus::html() ?> maxlength='5000' minlength="1" placeholder2="https://trustseal.enamad.ir?id=[...]&code=[...]"  placeholder='<?php echo T_("Paste you Enamad code here") ?>'></textarea>
          <?php } //endif ?>
        </div>
        <footer class="">
            <div class="f">
              <div class="cauto"><?php if(a($storeData, 'enamad')) {?><button class="btn-danger" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove") ?></button><?php } //endif ?></div>
              <div class="c"></div>
              <div class="cauto"><button  class="btn-success" ><?php echo T_("Save"); ?></button></div>
            </div>




        </footer>
    </div>
  </form>
</div>


