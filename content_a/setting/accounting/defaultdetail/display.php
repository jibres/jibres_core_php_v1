<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Accounting default assistant code");?></h2></header>
      <div class="body">

        <div class="" method="post" autocomplete="off">
          <div class="action">

            <div class="mB25">
              <?php if(\dash\data::assistantList()) {?>
                <label for="assistant_close_harmful_profit"><?php echo T_("Default assistant id in close all harmful-profit document") ?> </label>
                <select class="select22" name="assistant_close_harmful_profit" data-placeholder='<?php echo T_("Please choose assistant_id") ?>'>
                  <option value=""><?php echo T_("Please choose assistant_id") ?></option>
                  <?php show_assistant_list_html('assistant_close_harmful_profit') ?>
                </select>
              <?php } // endif ?>
              <small class="fc-mute">
                <?php echo T_("On default used from 3803 Accounting assistant code. if exists") ?>
              </small>
            </div>

            <div class="mB25">
              <?php if(\dash\data::assistantList()) {?>
                <label for="assistant_close_harmful_profit_accumulated_harmful_profit"><?php echo T_("Default assistant id in move all harmful-profit to accumulated harmful-profit document") ?> </label>
                <select class="select22" name="assistant_close_accumulated" data-placeholder='<?php echo T_("Please choose assistant_id") ?>'>
                  <option value=""><?php echo T_("Please choose assistant_id") ?></option>
                  <?php show_assistant_list_html('assistant_close_accumulated') ?>
                </select>
              <?php } // endif ?>
              <small class="fc-mute">
                <?php echo T_("On default used from 3701 Accounting assistant code. if exists") ?>
              </small>
            </div>

            <div class="mB25">
              <?php if(\dash\data::assistantList()) {?>
                <label for="assistant_closing"><?php echo T_("Default assistant id in closing year document") ?> </label>
                <select class="select22" name="assistant_closing" data-placeholder='<?php echo T_("Please choose assistant_id") ?>'>
                  <option value=""><?php echo T_("Please choose assistant_id") ?></option>
                  <?php show_assistant_list_html('assistant_closing') ?>
                </select>
              <?php } // endif ?>
              <small class="fc-mute">
                <?php echo T_("On default used from 1901 Accounting assistant code. if exists") ?>
              </small>
            </div>

              <div class="mB25">
              <?php if(\dash\data::detailsList()) {?>
                <label for="default_cost_vat"><?php echo T_("Default cost details id in vat") ?> </label>
                <select class="select22" name="default_cost_vat" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
                  <option value=""><?php echo T_("Please choose detail id") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) {?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a([], 'fill_value', 'put_on', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              <?php } // endif ?>
              <small class="fc-mute">
                <?php echo T_("On default used from 1901 Accounting assistant code. if exists") ?>
              </small>
            </div>

              <div class="mB25">
              <?php if(\dash\data::detailsList()) {?>
                <label for="default_income_vat"><?php echo T_("Default income details id in vat") ?> </label>
                <select class="select22" name="default_income_vat" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
                  <option value=""><?php echo T_("Please choose detail id") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) {?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a([], 'fill_value', 'put_on', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              <?php } // endif ?>
              <small class="fc-mute">
                <?php echo T_("On default used from 1901 Accounting assistant code. if exists") ?>
              </small>
            </div>


              <div class="mB25">
              <?php if(\dash\data::detailsList()) {?>
                <label for="default_cost_tax"><?php echo T_("Default cost details id in tax") ?> </label>
                <select class="select22" name="default_cost_tax" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
                  <option value=""><?php echo T_("Please choose detail id") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) {?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a([], 'fill_value', 'put_on', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              <?php } // endif ?>
              <small class="fc-mute">
                <?php echo T_("On default used from 1901 Accounting assistant code. if exists") ?>
              </small>
            </div>

              <div class="mB25">
              <?php if(\dash\data::detailsList()) {?>
                <label for="default_income_tax"><?php echo T_("Default income details id in tax") ?> </label>
                <select class="select22" name="default_income_tax" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
                  <option value=""><?php echo T_("Please choose detail id") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) {?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a([], 'fill_value', 'put_on', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              <?php } // endif ?>
              <small class="fc-mute">
                <?php echo T_("On default used from 1901 Accounting assistant code. if exists") ?>
              </small>
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



<?php

function show_assistant_list_html($_index)
{

  $savedValue = \dash\data::accountingSettingSaved();



  $lastCat = null;
  $showCat = null;
  foreach (\dash\data::assistantList() as $key => $value)
  {
    if($lastCat !== a($value, 'total_title'))
    {
      $showCat = true;
    }
    else
    {
      $showCat = false;
    }
    // set lastCat for next loop
    $lastCat = a($value, 'total_title');

    if($showCat)
    {
      echo '<optgroup label="';
      echo a($value, 'total_title');
      echo '">';
    }
    {
      echo '<option value="';
      echo a($value, 'id');
      echo '"';
      if(a($savedValue, $_index) === a($value, 'id'))
      {
        echo ' selected';
      }
      echo '>';
      echo a($value, 'code');
      echo ' - ';
      echo a($value, 'title');
      echo '</option>';
    }
    if($showCat)
    {
      echo "</optgroup>";
    }
}

}
?>