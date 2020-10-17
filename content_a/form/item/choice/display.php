<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
        <label for="ititle"><?php echo T_("Tilti of Choice") ?></label>
        <div class="input">
          <input type="text" name="title" required <?php \dash\layout\autofocus::html(); ?> value="<?php echo \dash\data::choiceDataRow_title() ?>">
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php if(\dash\data::editMode()) { echo T_("Edit"); }else{ echo T_("Add"); } ?></button>
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
              <tr <?php if(\dash\get::index($value, 'id') === \dash\request::get('cid')) { echo 'class="active"'; }?>>
                <td class="collapsing" data-handle ><i class="sf-sort"></i>
                  <input type="hidden" name="sort[]" value="<?php echo \dash\get::index($value, 'id') ?>">
                </td>
                <td><a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['cid' => \dash\get::index($value, 'id')]) ?>"><i class="sf-edit"></i> <?php echo \dash\get::index($value, 'title') ?></a></td>
                <td class="collapsing">
                  <?php if(\dash\get::index($value, 'id') === \dash\request::get('cid')) {?>
                    <div class="fc-mute"><i><?php echo T_("Editing...") ?></i></div>
                  <?php }else{ ?>
                    <div class="linkDel btn" data-confirm data-data='{"remove": "remove", "id" : "<?php echo \dash\get::index($value, 'id') ?>"}'><?php echo T_("Remove") ?></div>
                  <?php } //endif ?>
                </td>
              </tr>
            <?php } //endfor ?>
          </tbody>
        </table>
      </div>
    </form>
  <?php } //endif ?>
</div>
