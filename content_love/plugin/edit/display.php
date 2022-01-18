
<?php $dataRow = \dash\data::pluginDataRow(); ?>
<div class="avand">


  <form method="post" autocomplete="off">

    <div class="box">
      <div class="body">
        <h1><?php echo a($dataRow, 'plugin_title') ?></h1>
        <h2><?php echo T_("Business"). ': '. a(\dash\data::dataRow(), 'subdomain') ?></h2>

        <div class="input mb-2">
          <input type="tel" name="expiredate" value="<?php echo a($dataRow, 'expiredate') ?>" data-format="date" placeholder="<?php echo T_("Expire date") ?>">
        </div>
        <div class="row">
          <div class="c">
            <div class="radio3">
              <input type="radio" name="status" value="enable" id="status-enable" <?php if(a($dataRow, 'status') === 'enable') {echo 'checked';} ?>>
              <label for="status-enable"><?php echo T_("Enable") ?></label>
            </div>
          </div>
          <div class="c">
            <div class="radio3">
              <input type="radio" name="status" value="deleted" id="status-deleted" <?php if(a($dataRow, 'status') === 'deleted') {echo 'checked';} ?>>
              <label for="status-deleted"><?php echo T_("Deleted") ?></label>
            </div>
          </div>
        </div>


      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Edit") ?></button>
      </footer>
    </div>
  </form>


</div>