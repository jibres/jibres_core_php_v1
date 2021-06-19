<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Minimum order amount");?></h2></header>
      <div class="body">
        <p><?php echo T_("If you set this amount, customers must have at least this amount payable in their shopping cart to complete the order registration process. There will be no limit if you leave this amount blank.");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">


            <div class="c12 mB5">
              <label for="page_text"><?php echo T_("Amount"); ?></label>
              <div class="input">
                <input maxlength="13" type="text" id="minimumorderamount" name="minimumorderamount" value="<?php echo \dash\data::cartSettingSaved_minimumorderamount(); ?>" data-format='price' >
                <label for="minimumorderamount" class="addon"><?php echo \lib\store::currency() ?></label>
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