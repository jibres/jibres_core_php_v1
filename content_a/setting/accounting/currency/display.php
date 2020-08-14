<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Accounting currency");?></h2></header>
      <div class="body">

        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">
            <div class="c12 mB5">
              <label for="currency"><?php echo T_("Currency"); ?></label>
              <div class="input ">
                <input type="text" name="currency" id="currency" maxlength="50" value="<?php echo \dash\data::accountingSettingSaved_currency(); ?>">
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