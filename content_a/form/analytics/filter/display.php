<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>
<form method="post" id="formexec">
  <input type="hidden" name="execfilter" value="execfilter">
</form>

  <?php if(\dash\data::whereList()) {?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="sortable" value="sortable">
      <div class="tblBox">
        <table class="tbl1 v6 text-sm">
          <thead>
            <tr>
              <th class="collapsing"></th>
              <th><?php echo \dash\data::filterDetail_title() ?></th>
              <th class="collapsing"><?php echo \dash\fit::number(count(\dash\data::whereList())) ?> <small><?php echo T_("Filter") ?></small></th>
              <th></th>
              <th class="collapsing text-left"><?php echo T_("Inside") ?></th>
              <th class="collapsing text-left"><?php echo T_("Outside") ?></th>
              <th class="collapsing text-left"><?php echo T_("Count after") ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0; $first = true; $last = null; foreach (\dash\data::whereList() as $key => $value) { $i++; $last = a($value, 'count_after'); ?>
              <?php if($first) { $first = false;?>
                <tr class="positive">
                  <td class="collapsing text-sm"><span class=""><?php echo T_("All") ?></span></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td colspan="3" class="collapsing text-left ltr font-bold font-14 fc-blue"><?php echo \dash\fit::price(\dash\data::countAll()) ?></td>
                </tr>
              <?php } // endif ?>
              <tr>
                <td class="collapsing text-sm"><div class="btn-link-danger" data-confirm data-data='{"remove": "remove", "id" : "<?php echo a($value, 'id') ?>"}'><?php echo T_("Remove") ?></div></td>
                <td class="collapsing text-sm">
                  <a href="<?php echo \dash\url::this().'/report/answer?'. \dash\request::fix_get(['iid' => a($value, 'item_id')]) ?>">
                    <span class="font-bold"><?php if(a($value, 'item_id')) { echo \dash\fit::number(a($value, 'item_id')) . '.'; } ?> </span> <?php echo a($value, 'field_title') ?>
                  </a>

                </td>
                <td class="collapsing"><?php echo a($value, 'condition_title') ?></td>
                <td class="collapsing"><?php echo a($value, 'value') ?></td>
                <td class="collapsing text-left ltr"><?php echo \dash\fit::price(a($value, 'inside')) ?></td>
                <td class="collapsing text-left ltr"><?php echo \dash\fit::price(a($value, 'outside')) ?></td>
                <td class="collapsing text-left ltr font-bold font-14 fc-blue"><?php echo \dash\fit::price(a($value, 'count_after')) ?></td>
              </tr>
            <?php } //endfor ?>
          </tbody>
          <tfoot>
            <tr>
                <td class="collapsing text-sm"><span class=""><?php echo T_("Remain") ?></span></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="3" class="collapsing text-left ltr font-bold"><?php echo \dash\fit::price($last) ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </form>
  <?php }else{ ?>
    <div class="msg font-14 text-center warn2"><?php echo T_("No filter added") ?></div>
  <?php } //endif ?>
