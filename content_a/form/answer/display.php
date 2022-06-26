 <div class="tblBox">

  <table class="tbl1 v1">
    <thead>
      <tr>
        <th class="collapsing"><?php echo T_("ID") ?></th>
        <th><?php echo T_("Start date") ?></th>
        <th><?php echo T_("Count answer") ?></th>
        <th><?php echo T_("Status") ?></th>
        <th class="collapsing"></th>
        <th class="collapsing"><?php echo T_("Review") ?></th>
        <th class="collapsing"><?php echo T_("Detail") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <td class="collapsing"><?php echo \dash\fit::number(a($value, 'id')) ?></td>
          <td><?php echo \dash\fit::date_time(a($value, 'startdate')); ?></td>
          <td><?php echo \dash\fit::number(a($value, 'count_answer')); ?></td>
          <td><?php echo T_(strval(a($value, 'status'))); ?></td>
          <td class="collapsing">
            <?php if(a($value, 'user_id')) {?><a class="btn-link  leading-none  text-sm" href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. \dash\coding::encode(a($value, 'user_id')); ?>"><?php echo T_("View User profile") ?></a><?php } //endif ?>
            <?php if(a($value, 'factor_id')) {?><a class="btn-link  leading-none  text-sm" href="<?php echo \dash\url::kingdom(). '/a/order/comment?id='. a($value, 'factor_id'); ?>"><?php echo T_("View Order") ?></a><?php } //endif ?>
            <?php if(a($value, 'transaction_id')) {?><a class="btn-link  leading-none text-sm" href="<?php echo \dash\url::kingdom(). '/crm/transactions/detail?id='. a($value, 'transaction_id'); ?>"><?php echo T_("View Transaction") ?></a><?php } //endif ?>
            <?php if(a($value, 'ticket_id')) {?><a class="btn-link  leading-none  text-sm" href="<?php echo \dash\url::kingdom(). '/crm/ticket/view?id='. a($value, 'ticket_id'); ?>"><?php echo T_("View Ticket") ?></a><?php } //endif ?>
          </td>
          <td class="collapsing"><?php if(a($value, 'review')){echo \dash\utility\icon::svg('check-circle', 'bootstrap', 'green', 'w-4') ;}else{echo \dash\utility\icon::svg('question-circle', 'bootstrap', '#D3D3D3', 'w-4');} ?></td>
          <td class="collapsing"><a class="btn-secondary btn-sm" href="<?php echo \dash\url::that(). '/detail?id='. \dash\request::get('id'). '&aid='. a($value, 'id'); ?>"><?php echo T_("Detail") ?></a></td>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
  </div>
 <?php \dash\utility\pagination::html(); ?>

