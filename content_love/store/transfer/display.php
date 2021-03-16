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


   <nav class="items">
    <ul>
      <li>
        <a class="f item" href="<?php echo \dash\url::kingdom(). '/'.\dash\store_coding::encode(a($dataRow, 'id'));?>">
          <div class="key"><?php echo T_("Go to admin") ?></div>
          <div class="value ltr"><?php echo \dash\store_coding::encode(a($dataRow, 'id'));  ?></div>
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
          <select class="select22" name="fuel" id="fuel">

            <option value="jibres101" <?php if(\dash\data::dataRowData_fuel() === 'jibres101') { echo 'selected'; } ?>>jibres101</option>
            <option value="jibres202" <?php if(\dash\data::dataRowData_fuel() === 'jibres202') { echo 'selected'; } ?>>jibres202</option>
            <option value="jibres303" <?php if(\dash\data::dataRowData_fuel() === 'jibres303') { echo 'selected'; } ?>>jibres303</option>


          </select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Transfer") ?></button>
      </footer>
    </div>
  </form>

</div>