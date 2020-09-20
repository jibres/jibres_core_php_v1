<div class="avand-xl">
  <form method="post" autocomplete="off">
    <div class="box">
      <header><h2><?php echo \dash\data::filterDetail_title() ?></h2></header>
      <div class="body">
        <label for="ititle"><?php echo T_("Question") ?></label>
        <select class="select22" name="field">
          <option value=""><?php echo T_("Please select on item") ?></option>
          <?php foreach (\dash\data::fields() as $key => $value) {?>
            <option value="<?php echo \dash\get::index($value, 'field') ?>"><?php echo \dash\get::index($value, 'title') ?></option>
          <?php } //endfor ?>
        </select>

        <label for="condition"><?php echo T_("Operator") ?></label>
        <select class="select22" name="condition">
          <option value=""><?php echo T_("Please select on item") ?></option>
          <option value="IS NULL">IS NULL</option>
          <option value="IS NOT NULL">IS NOT NULL</option>
          <option value=">=">>=</option>
          <option value="<="><=</option>
          <option value="=">=</option>
          <option value="!=">!=</option>

        </select>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </form>

  <?php if(\dash\data::whereList()) {?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="sortable" value="sortable">
      <div class="tblBox font-14">
        <table class="tbl1 v4">
          <tbody>
            <?php foreach (\dash\data::whereList() as $key => $value) {?>
              <tr>
                <td><?php echo \dash\get::index($value, 'field_title') ?></td>
                <td><?php echo \dash\get::index($value, 'condition') ?></td>
                <td class="collapsing">
                    <div class="linkDel btn" data-confirm data-data='{"remove": "remove", "id" : "<?php echo \dash\get::index($value, 'id') ?>"}'><?php echo T_("Remove") ?></div>
                </td>
              </tr>
            <?php } //endfor ?>
          </tbody>
        </table>
      </div>
    </form>
  <?php } //endif ?>
</div>
