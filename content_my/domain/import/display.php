

<div class="f justify-center">
 <div class="c6 m8 s12">
  <div class="cbox">


    <form method="post" autocomplete="off">
      <p>
      	<?php echo T_("Import your domain to manage it") ?>
      </p>
      <label><?php echo T_("Get your domain list"); ?></label>
      <textarea class="txt ltr" rows="15" name="domains" placeholder="<?php echo T_("Every domain in one line") ?>"></textarea>

      <div class="check1 mT20">
	  <input type="checkbox" id="sChk1" name="autorenew">
	  <label for="sChk1"><?php echo T_("Enable auto renew for this domains") ?></label>
	</div>

      <div class="txtRa mT10">
       <button class="btn success"><?php echo T_("Import domain"); ?></button>
      </div>

   </form>


  </div>
 </div>
</div>
