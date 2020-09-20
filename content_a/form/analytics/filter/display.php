
<div class="box">
  <div class="body">
    <div class="btn master" data-confirm data-data='{"execfilter": "execfilter"}'><?php echo T_("Execute filter") ?></div>
  </div>
</div>


  <?php if(\dash\data::whereList()) {?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="sortable" value="sortable">
      <div class="tblBox font-14">
        <table class="tbl1 v4">
          <thead>
            <tr>
              <th class="collapsing"></th>
              <th></th>
              <th></th>
              <th class="collapsing txtL"><?php echo T_("Inside") ?></th>
              <th class="collapsing txtL"><?php echo T_("Outside") ?></th>
              <th class="collapsing txtL"><?php echo T_("Count after") ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (\dash\data::whereList() as $key => $value) {?>
              <tr>
                <td class="collapsing font-12"><span class=""><?php echo \dash\fit::number(\dash\get::index($value, 'item_id')) ?>.</span></td>
                <td class="collapsing font-12"><?php echo \dash\get::index($value, 'field_title') ?></td>
                <td><?php echo \dash\get::index($value, 'condition_title') ?></td>
                <td><?php echo \dash\get::index($value, 'value') ?></td>
                <td class="collapsing txtL ltr"><?php echo \dash\fit::price(\dash\get::index($value, 'inside')) ?></td>
                <td class="collapsing txtL ltr"><?php echo \dash\fit::price(\dash\get::index($value, 'outside')) ?></td>
                <td class="collapsing txtL ltr txtB"><?php echo \dash\fit::price(\dash\get::index($value, 'count_after')) ?></td>
              </tr>
            <?php } //endfor ?>
          </tbody>
        </table>
      </div>
    </form>
  <?php }else{ ?>
    <div class="msg font-14 txtC warn2"><?php echo T_("No filter added") ?></div>
  <?php } //endif ?>
