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

          </p>
            <label for="idomain"><?php echo T_("Domain #1"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
              <input type="text" name="domain1" id="idomain"  value="<?php echo \dash\get::index($storeData, 'domain1'); ?>" autofocus maxlength='70' minlength="1"  >
            </div>

            <br>
            <small><?php echo T_("You can connect multi domain to your store :) "); ?></small>
            <br>

            <label for="idomain"><?php echo T_("Domain #2"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
              <input type="text" name="domain2" id="idomain"  value="<?php echo \dash\get::index($storeData, 'domain2'); ?>"  maxlength='70' minlength="1" >
            </div>
        </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
    </div>
  </form>
 </div>
</div>


