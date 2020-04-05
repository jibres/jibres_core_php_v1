<?php
$storeData = \dash\data::store_store_data();
?>


<div class="f justify-center">
 <div class="c6 s12 pA10">
  <form method="post" autocomplete="off">
    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Connect store to your domain");?></h2></header>
        <div class="body">
          <p class="mB0-f">
            <?php echo T_("You can connect your store to special domain"); ?>
            <br>
            <?php echo T_("To route domain set your CNAME of your domain to alise.jibres.com"); ?>
            <?php if(\dash\url::tld() === 'ir' || \dash\url::isLocal()) {?>
              <div class="msg success2">
                <?php echo T_("Your can buy new domain here"); ?>
                <a href="<?php echo \dash\url::sitelang(). '/my/domain'; ?>" data-direct target="_blank"><?php echo T_("Domain Center"); ?></a>
              </div>
            <?php } // endif ?>

          </p>
            <label for="idomain"><?php echo T_("Domain"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
              <input type="text" name="domain" id="idomain"  value="<?php echo \dash\get::index($storeData, 'domain'); ?>" autofocus maxlength='70' minlength="1"  >
            </div>

            <div class="hide">
              <br>
              <small><?php echo T_("You can connect multi domain to your store :) "); ?></small>
              <br>

              <label for="idomain"><?php echo T_("Domain #2"); ?> <span class="fc-red">*</span></label>
              <div class="input ltr">
                <input type="text" name="domain2" id="idomain"  value="<?php echo \dash\get::index($storeData, 'domain2'); ?>"  maxlength='70' minlength="1" >
              </div>
            </div>
        </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
    </div>
  </form>
 </div>
</div>


