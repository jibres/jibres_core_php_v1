<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
        <label for="ititle"><?php echo T_("Tilti of Choice") ?></label>
        <div class="input">
          <input type="text" name="title" required <?php \dash\layout\autofocus::html(); ?>>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </form>

  <?php if(\dash\data::choiceList()) {?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="sortable" value="sortable">
      <div class="tblBox font-14">
        <table class="tbl1 v4">
          <tbody data-sortable>
            <?php foreach (\dash\data::choiceList() as $key => $value) {?>
              <tr>
                <td class="collapsing" data-handle ><i class="sf-sort"></i>
                  <input type="hidden" name="sort[]" value="<?php echo \dash\get::index($value, 'id') ?>">
                </td>
                <td><?php echo \dash\get::index($value, 'title') ?></td>
                <td class="collapsing"><div class="linkDel btn" data-confirm data-data='{"remove": "remove", "id" : "<?php echo \dash\get::index($value, 'id') ?>"}'><?php echo T_("Remove") ?></div></td>
              </tr>
            <?php } //endfor ?>
          </tbody>
        </table>
      </div>
    </form>
  <?php } //endif ?>
</div>
