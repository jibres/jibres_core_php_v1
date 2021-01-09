<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-md">
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