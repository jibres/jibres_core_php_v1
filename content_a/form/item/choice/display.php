<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
        <label for="ititle"><?php echo T_("Tilti of Choice") ?></label>
        <div class="input">
          <input type="text" name="title" required <?php \dash\layout\autofocus::html(); ?> value="<?php echo \dash\data::choiceDataRow_title() ?>">
        </div>
        <?php if(a(\dash\data::itemDetail(), 'type') === 'list_amount') {?>
          <label for="iprice"><?php echo T_("Price") ?></label>
          <div class="input">
            <input type="tel" name="price" required <?php \dash\layout\autofocus::html(); ?> value="<?php echo round(\dash\data::choiceDataRow_price()) ?>" data-format="price"  maxlength="15">
          </div>
        <?php } // endif ?>

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
              <tr <?php if(a($value, 'id') === \dash\request::get('cid')) { echo 'class="active"'; }?>>
                <td class="collapsing sortHandle" data-handle ><i class="sf-sort"></i>
                  <input type="hidden" name="sort[]" value="<?php echo a($value, 'id') ?>">
                </td>
                <td><a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['cid' => a($value, 'id')]) ?>"><i class="sf-edit"></i> <?php echo a($value, 'title');

                  if(a($value, 'price'))
                  {
                    echo '<span class="px-4 text-gray-400">';

                    echo \dash\fit::number($value['price']). ' '. \lib\store::currency();
                    echo '</span>';

                  }
                ?>

              </a>


                </td>
                <td class="collapsing">
                  <?php if(a($value, 'id') === \dash\request::get('cid')) {?>
                    <div class="fc-mute"><i><?php echo T_("Editing...") ?></i></div>
                  <?php }else{ ?>
                    <div class="btn-link-danger" data-confirm data-data='{"remove": "remove", "id" : "<?php echo a($value, 'id') ?>"}'><?php echo T_("Remove") ?></div>
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
