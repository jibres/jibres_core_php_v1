<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Product Text");?></h2></header>
      <div class="body">
        <p><?php echo T_("If it takes time for your product to be ready and can be sent to the customer, enter the time in this field. Of course, each product has a separate preparation time, which in the order of the time entered here is added to the product preparation time.");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">
            <div class="c12 mB5">
              <div class="input">
                <input type="text" name="preparationtime" id="ipreparationtime" value="<?php echo \dash\data::productSettingSaved_preparationtime(); ?>"  autocomplete="off" maxlength="3" data-format='number'>
                <div class="addon"><?php echo T_("Hour"); ?></div>
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