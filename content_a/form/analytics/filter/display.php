<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>


  <?php if(\dash\data::whereList()) {?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="sortable" value="sortable">
      <div class="tblBox">
        <table class="tbl1 v6 font-12">
          <thead>
            <tr>
              <th class="collapsing"></th>
              <th><?php echo \dash\data::filterDetail_title() ?></th>
              <th class="collapsing"></th>
              <th></th>
              <th class="collapsing txtL"><?php echo T_("Inside") ?></th>
              <th class="collapsing txtL"><?php echo T_("Outside") ?></th>
              <th class="collapsing txtL"><?php echo T_("Count after") ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0; $first = true; $last = null; foreach (\dash\data::whereList() as $key => $value) { $i++; $last = \dash\get::index($value, 'count_after'); ?>
              <?php if($first) { $first = false;?>
                <tr class="positive">

                <td class="collapsing font-12"><span class=""><?php echo T_("All") ?></span></td>
                <td></td>
                <td></td>
                <td></td>

                <td colspan="3" class="collapsing txtL ltr txtB font-14 fc-blue"><?php echo \dash\fit::price(\dash\get::index($value, 'count_after') + \dash\get::index($value, 'outside')) ?></td>
                </tr>
              <?php } // endif ?>
              <tr>
                <td class="collapsing font-12"><?php echo \dash\fit::number($i) ?></td>
                <td class="collapsing font-12"><span class="txtB"><?php echo \dash\fit::number(\dash\get::index($value, 'item_id')) ?>.</span> <?php echo \dash\get::index($value, 'field_title') ?></td>
                <td class="collapsing"><?php echo \dash\get::index($value, 'condition_title') ?></td>
                <td class="collapsing"><?php echo \dash\get::index($value, 'value') ?></td>
                <td class="collapsing txtL ltr"><?php echo \dash\fit::price(\dash\get::index($value, 'inside')) ?></td>
                <td class="collapsing txtL ltr"><?php echo \dash\fit::price(\dash\get::index($value, 'outside')) ?></td>
                <td class="collapsing txtL ltr txtB font-14 fc-blue"><?php echo \dash\fit::price(\dash\get::index($value, 'count_after')) ?></td>
              </tr>
            <?php } //endfor ?>
          </tbody>
          <tfoot>
            <tr>

                <td class="collapsing font-12"><span class=""><?php echo T_("Remain") ?></span></td>
                <td></td>
                <td></td>
                <td></td>

                <td colspan="3" class="collapsing txtL ltr txtB"><?php echo \dash\fit::price($last) ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </form>
  <?php }else{ ?>
    <div class="msg font-14 txtC warn2"><?php echo T_("No filter added") ?></div>
  <?php } //endif ?>
