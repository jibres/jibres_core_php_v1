<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Kavenegar API KEY");?></h2></header>
      <div class="body">
        <p><?php echo T_("API");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">

            <div class="c12 mB5">
              <label for="kavenegar_apikey"><?php echo T_("Kavenegar API KEY"); ?></label>
              <div class="input ltr">
                <input type="text" name="kavenegar_apikey" id="kavenegar_apikey" value="<?php echo \dash\data::smsSettingSaved_kavenegar_apikey(); ?>">
              </div>
            </div>

          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
  </div>
</div>

</form>