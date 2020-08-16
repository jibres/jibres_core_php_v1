<?php
$currentVariants = \dash\data::currentVariants();
if(!is_array($currentVariants))
{
  $currentVariants = [];
}

$remain_count = \dash\data::remainCount();
if(!is_numeric($remain_count))
{
  $remain_count = 0;
}

?>
<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <p>
          <?php echo T_("You have already added variants to this product. You can now add a specific type to one of the added variants types"); ?>
        </p>

        <?php foreach ($currentVariants as $key => $value) {?>
          <div class="example">
            <div class="mA5"><?php echo $key ?></div>
            <?php foreach ($value as $v) {?>
            <div class="ibtn" data-removeElement ><i data-ajaxify  class="sf-times fc-red"></i> <span><?php echo $v; ?></span></div>
            <?php } //endif ?>
          </div>
        <?php } //endfor ?>


        <?php for ($i = 1; $i <= $remain_count ; $i++) { $myI = $remain_count + 1 - $i;?>
          <div class="f">
          <div class="cauto mLa5">
            <label><?php echo T_("New Property"); ?></label>
            <div class="input">
              <input type="text" name="optionname<?php echo $myI; ?>">
            </div>
          </div>

           <div class="c mLa5">
            <label><?php echo T_("Value"); ?></label>
            <div class="input">
              <input type="text" name="optionvalue<?php echo $myI; ?>">
            </div>
          </div>

          </div>


      <?php } //endfor ?>

        </div>

      <footer class="txtRa">
        <button class="btn master" name="submitall" value="makevariantsagain"><?php echo T_("Add"); ?></button>
      </footer>
    </div>
  </div>

</form>
