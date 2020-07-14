<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Cart Text");?></h2></header>
      <div class="body">
        <p><?php echo T_("Cart.me");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">


            <div class="c12 mB5">
              <label for="page_text"><?php echo T_("Max product in cart"); ?></label>
              <div class="input">
                <input maxlength="3" type="text" name="maxproductincart" value="<?php echo \dash\data::cartSettingSaved_maxproductincart(); ?>" data-format='number' >
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