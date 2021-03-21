<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-lg">
  <nav class="items ltr">
    <ul>

      <li>
        <a class="f item">
          <div class="key">Current Fuel</div>
          <div class="value txtB"><?php echo $dataRow['fuel'] ?></div>
        </a>
      </li>
    </ul>
  </nav>


  <form method="post" autocomplete="off">
    <input type="hidden" name="changefuel" value="1">
    <div class="box">
      <div class="body">
        <label for="fuel"><?php echo T_("Chage business fuel") ?></label>
        <div>
          <select class="select22" name="newfuel" id="fuel">
            <?php foreach (\dash\data::serverList() as $key => $value) {?>
            <option value="<?php echo a($value, 'fuelname'); ?>" <?php if(\dash\data::dataRow_fuel() === a($value, 'fuelname')) { echo 'selected'; } ?>><?php echo a($value, 'title') ?></option>
            <?php } //endif ?>
          </select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn danger"><?php echo T_("Transfer") ?></button>
      </footer>
    </div>
  </form>


   <form method="post" autocomplete="off" class="hide" id="formrun">
    <input type="hidden" name="run" value="run">
  </form>

</div>