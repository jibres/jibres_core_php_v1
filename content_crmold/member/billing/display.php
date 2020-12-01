


<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">
 <div class="cauto s12 pA5">
<?php require_once(root. 'content_crm/member/psidebar.php'); ?>

 </div>
 <div class="c s12 pA5">




<?php if(\dash\data::history() && is_array(\dash\data::history())) {?>


    <h3 id="billing-history" class="pA10"><?php echo T_("Billing History"); ?></h3>
    <table class="tbl1 v6 fs14">
      <thead class="primary">
        <tr>
          <th class="s0"><?php echo T_("Title"); ?></th>
          <th><?php echo T_("Date"); ?></th>
          <th><?php echo T_("Value"); ?></th>
          <th><?php echo T_("Budget After"); ?></th>


          <?php if(\dash\permission::supervisor()) {?>

            <th><?php echo T_("Date"); ?></th>
            <th><?php echo T_("Verify"); ?></th>
            <th><?php echo T_("Detail"); ?></th>

          <?php } //endif ?>

        </tr>
      </thead>
      <tbody>

<?php foreach (\dash\data::history() as $key => $value) {?>





         <tr>
          <td class="s0"><?php echo \dash\get::index($value, 'title'); ?></td>

  <td title='<?php echo \dash\fit::date(\dash\get::index($value, 'date')); ?>'><?php echo \dash\fit::date_human(\dash\get::index($value, 'date')); ?></td>


          <td>
            <?php
            if(isset($value['plus']) && $value['plus'])
            {
              echo '+'. \dash\fit::number($value['plus']);
            }
            elseif(isset($value['minus']) && $value['minus'])
            {
              echo '-'. \dash\fit::number($value['minus']);
            }
            ?>

          </td>
          <td><?php echo \dash\fit::number(\dash\get::index($value, 'budget')); ?> <?php if(isset($value['budget']) && $value['budget']){ echo \lib\currency::unit();  }?></td>

          <?php if(\dash\permission::supervisor()) {?>
            <td title="<?php echo \dash\fit::date(\dash\get::index($value, 'datecreated')); ?>"><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></td>
            <td><?php if(isset($value['verify']) && $value['verify']) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></td>
            <td><a title="<?php echo \dash\get::index($value, 'token'); ?>" class="btn xs warn" href="<?php echo \dash\url::kingdom(); ?>/pay/<?php echo \dash\get::index($value, 'token'); ?>"><?php echo T_("Detail"); ?></a></td>
          <?php }//endif ?>
         </tr>
<?php }//endfor ?>

      </tbody>
    </table>
    <?php \dash\utility\pagination::html(); ?>

<?php }else{ ?>

<p class="msg info2 txtC fs14"><?php echo T_("You are not have payment history yet!"); ?></p>

<?php } //endif ?>






 </div>
</div>

