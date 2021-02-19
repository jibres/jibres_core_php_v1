<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-lg">
  <nav class="items ltr">
    <ul>
      <li>
        <a class="f item">
          <div class="key">ID</div>
          <div class="value txtB"><?php echo $dataRow['id'] ?></div>
        </a>
      </li>
      <li>
        <a class="f item">
          <div class="key">Subdomain</div>
          <div class="value txtB"><?php echo $dataRow['subdomain'] ?></div>
        </a>
      </li>
      <li>
        <a class="f item">
          <div class="key">Fuel</div>
          <div class="value txtB"><?php echo $dataRow['fuel'] ?></div>
        </a>
      </li>
      <li>
        <a class="f item">
          <div class="key">Status</div>
          <div class="value txtB"><?php echo $dataRow['status'] ?></div>
        </a>
      </li>
      <li>
        <a class="f item">
          <div class="key">IP</div>
          <div class="value txtB"><?php echo long2ip($dataRow['ip']) ?></div>
        </a>
      </li>
      <li>
        <a class="f item">
          <div class="key">Date created</div>
          <div class="value txtB"><?php echo \dash\fit::date_time($dataRow['datecreated']) ?></div>
        </a>
      </li>
    </ul>
  </nav>

  <?php if($dataRow['status'] === 'deleted') {?>

   <nav class="items">
    <ul>
      <li>
        <div class="f item" data-confirm data-data='{"reenable": "reenable"}'>
          <div class="key"><?php echo T_("Re enable this business") ?></div>
          <div class="go detail nok"></div>
        </div>
      </li>
    </ul>
  </nav>

  <?php } //endif ?>

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
    <input type="hidden" name="setenterprise" value="1">
    <div class="box">
      <div class="body">
        <label for="enterprise"><?php echo T_("Chage business enterprise") ?></label>
        <div>
          <select class="select22" name="enterprise" id="enterprise">
            <option value="0"><?php echo T_("None") ?></option>
            <option value="rafiei" <?php if(\dash\data::dataRowData_enterprise() === 'rafiei') { echo 'selected'; } ?>><?php echo T_("Rafiei") ?></option>
          </select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>


   <form method="post" autocomplete="off">
    <input type="hidden" name="set_storage" value="1">
    <div class="box">
      <div class="body">
        <label for="storage"><?php echo T_("Chage business storage limit") ?></label>
        <div class="input">
          <label for="storage" class="addon">MB</label>
          <input type="number" name="storage" value="<?php echo \dash\data::dataRowData_storage() ?>" id="storage">
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save Storage limit") ?></button>
      </footer>
    </div>
  </form>



  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
        <p><?php echo T_("You can change business subdomain") ?></p>
        <div class="input ltr">
          <input type="text" name="subdomain" value="<?php echo $dataRow['subdomain'] ?>" required>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn danger"><?php echo T_("Change subdomian") ?></button>
      </footer>
    </div>
  </form>
</div>