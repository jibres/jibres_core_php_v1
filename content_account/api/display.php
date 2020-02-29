
<div class="f justify-center">
  <div class="c4 s12">
    <div class="cbox">

      <a href="https://api.jibres.<?php echo \dash\url::tld(); ?>" class="btn block outline"><?php echo \dash\data::myTitle(); ?></a>

      <div class="msg danger2 mT20">
        <div><?php echo T_("Protect this key like a password!"); ?></div>
        <div><?php echo T_("By this key you can access to your account"); ?></div>
      </div>

      <form method="post">
        <input type="hidden" name="add" value="apikey">
        <div class="input">
          <label><?php echo T_("YOUR API KEY"); ?></label>
          <input type="text" name="apikey" value="<?php echo \dash\data::apikey_auth(); ?>" readonly  class="txtC" placeholder='<?php echo T_("GENERATE NEW API KEY"); ?>'>
        </div>

      <?php if(\dash\data::apikey_auth()) {?>

    		<button data-confirm data-data='{"remove" : "apikey"}' class="btn warn mT5 block"><?php echo T_("Remove"); ?></button>

    	<?php }else{ ?>

    		<button data-confirm data-data='{"add" : "apikey"}' class="btn primary mT5 block"><?php echo T_("Get new API KEY"); ?></button>

    	<?php } //endif ?>


        </div>
      </form>
    </div>

  </div>

</div>

