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
  <input type="hidden" name="editoption" value="editoption">
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <p>
          <?php echo T_("You have already added variants to this product. You can now add a specific type to one of the added variants types"); ?>
          <?php echo T_("Or delete a specific type of product variant"); ?>

          <div class="fc-red"><?php echo T_("Note that if you delete one type of variant, all products that have that type of variant will be removed!") ?></div>
        </p>
        <?php foreach ($currentVariants as $key => $value) {?>
          <div class="example">
            <div class="mA5"><?php echo $key ?></div>
            <?php foreach ($value as $v) {?>
              <div class="ibtn"><i class="sf-trash fc-red fs14" data-confirm data2-title2 data-msg='<?php echo T_("Remove all variants by :val :color?", ['val' => $key, 'color' => $v]) ?>'></i> <span><?php echo $v; ?></span></div>
            <?php } //endif ?>
          </div>
        <?php } //endfor ?>
        <?php if($remain_count) {?>
          <div class="example">
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
        <?php } //endif ?>
      </div>
      <footer class="txtRa">
        <button class="btn master" name="submitall" value="makevariantsagain"><?php echo T_("Add"); ?></button>
      </footer>
    </div>
  </div>
</form>