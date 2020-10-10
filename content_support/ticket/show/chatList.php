<?php

$myStatus         = \dash\data::masterTicketDetail_status();
$dataTable        = \dash\data::dataTable();

if(!is_array($dataTable))
{
  $dataTable = [];
}

$myID             = \dash\coding::encode(\dash\request::get('id'));
$myTag            = \dash\app\term::load_tag_html(["post_id" => $myID ,  "format" => 'array', "type" => "support_tag", "related" => "tickets"]);
$cpTagSupportEdit = \dash\permission::check('cpTagSupportEdit');
$urlThis = \dash\url::this();
?>



<div class="cbox">
  <div class="msg <?php if(\dash\data::masterTicketDetail_colorClass()) { echo \dash\data::masterTicketDetail_colorClass(); }else{ echo 'pain';} ?> special fs10 f" title='<?php echo T_("Status"); ?> <b><?php echo T_(ucfirst($myStatus)); ?></b>'>
    <div class="cauto pRa10"><span class="badge rounded" title='<?php echo T_("Ticket No"); ?>'><?php echo \dash\fit::text(\dash\data::masterTicketDetail_id()); ?></span></div>
    <?php if(\dash\data::masterTicketDetail_subdomain()) {?>
      <div class="cauto pRa10"><a class="badge" href="<?php echo \dash\url::here(); ?>/ticket?access=all&subdomain=<?php echo \dash\data::masterTicketDetail_subdomain(); ?>"><?php echo ucfirst(\dash\data::masterTicketDetail_subdomain()); ?></a></div>
    <?php } ?>
    <div><?php echo \dash\data::masterTicketDetail_title(); ?></div>
    <div class="cauto os fs08 compact" title='<?php echo T_("Last activity"); if(isset($dataTable[0]['datemodified'])) { echo ' '. \dash\fit::date($dataTable[0]['datemodified']); } ?>'><?php echo \dash\fit::date(\dash\data::masterTicketDetail_datecreated()); ?></div>
  </div>

<?php

if($myTag)
{
  echo '<div class="tagBox">';

  foreach ($myTag as $key => $value)
  {
    if((isset($value['status']) && $value['status'] == 'enable' ) || $cpTagSupportEdit)
    {
      $meta = null;
      if(isset($value['meta']['color']))
      {
        $meta = $value['meta']['color'];
      }
      echo '<a class="btn rounded sm mB5 '. $meta. '" href="'. $urlThis.'?tag='. \dash\get::index($value, 'slug'). '">'. \dash\get::index($value, 'title').'</a>';
    }
  }
  echo '</div>';
}
?>

<?php if(\dash\permission::check('supportTicketAnswer')) {?>

 <form method="post" autocomplete="off">
    <input type="hidden" name="TicketFormType" value="setTitle">
    <label for="title"><?php echo T_("Ticket Subject"); ?></label>
    <div class="input">
      <input type="text" name="title" id="title" placeholder='<?php echo T_("Subject of ticket"); ?>' value="<?php echo \dash\data::masterTicketDetail_title() ?>"  maxlength='150' minlength="1" title='<?php echo T_("Set the title to get faster"); ?>'>
      <button class="btn addon primary"><?php echo T_("Save"); ?></button>
    </div>
 </form>

<?php } //endif ?>


<?php if(\dash\data::superDataTable() && is_array(\dash\data::superDataTable())) {?>

<?php $lastRecordVisitor = false; ?>


  <table class="tbl1 v5 responsive">
    <tbody>
      <?php foreach (\dash\data::superDataTable() as $xdate => $xlist)
      {
        // don't error in foreach
        if(!is_array($xlist))
        {
          continue;
        }

        foreach ($xlist as $record)
        {

          if(isset($record['xtype']) && $record['xtype'] === 'ticket')
          {

            if($lastRecordVisitor)
            {
              $lastRecordVisitor = false;
              echo '</div>
                  </td>
                </tr>';
            }

      ?>



      <tr class="<?php echo \dash\get::index($record, 'value', 'rowColor'); ?> <?php if(\dash\get::index($record, 'value', 'type') === 'ticket_note') { echo  ' disabled ';} ?>" id='msg<?php echo \dash\get::index($record, 'value', 'id'); ?>'>
        <td class="collapsing pRa10">
          <img src="<?php echo \dash\get::index($record, 'value', 'avatar'); ?>" class="avatar mRa10" alt="<?php echo \dash\get::index($record, 'value', 'displayname'); ?>">
          <span class="txtB s0 fs08"><?php echo \dash\get::index($record, 'value', 'displayname'); ?></span>
          <?php if(\dash\permission::check('supportTicketShowMobile')) {?>

          <div class="txtRa fs08"><?php echo \dash\fit::mobile(\dash\get::index($record, 'value', 'mobile')); ?></div>

          <nav class="txtRa">
            <?php if(\dash\permission::check('supportTicketManage')) {?><a href="<?php echo $urlThis; ?>?user_id=<?php echo \dash\get::index($record, 'value', 'user_id'). \dash\data::accessGetAnd(); ?>" title='<?php echo T_("User tickets"); ?>'><i class="sf-question-circle"></i></a><?php } ?>
            <?php if(\dash\permission::check('cpUsersView')) {?><a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo \dash\get::index($record, 'value', 'user_id'); ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a><?php } ?>
          </nav>
        <?php }//endif ?>
        </td>
        <td class="pRa10 breakWord">
          <div class="selectable">
            <?php echo nl2br(\dash\get::index($record, 'value', 'content')); ?>
          </div>
          <div class="f mT10">

        <?php if(isset($record['value']['file'])) {?>

           <div>
            <a class="badge" href="<?php echo $record['value']['file']; ?>" target="_blank"><?php echo T_("View attachment"); ?></a>
           </div>

        <?php }//endif ?>
           <div class="cauto os fc-mute">
            <small title='<?php echo \dash\fit::date(\dash\get::index($record, 'value', 'datecreated')); ?>'><?php echo \dash\fit::date_human(\dash\get::index($record, 'value', 'datecreated')); ?></small>

        <?php if(\dash\permission::check('supportEditMessage')) {?>

            <a class="fs08 mLa10" href="<?php echo \dash\url::here(); ?>/message/edit?id=<?php echo \dash\get::index($record, 'value', 'id'); ?>"><?php echo T_("Edit"); ?></a>

            <?php if(isset($record['value']['type']) && $record['value']['type'] === 'ticket_note') {?>

              <i class="fc-red sf-user-secret"></i>
            <?php } //endif ?>
        <?php } //endif ?>
           </div>
          </div>
        </td>
      </tr>


<?php
}
elseif(isset($record['xtype']) && $record['xtype'] === 'log')
{

    if($lastRecordVisitor)
    {
      $lastRecordVisitor = false;
      echo '</div>
          </td>
        </tr>';
    }
?>




<tr>
  <td class="collapsing pRa10">
      <img src="<?php echo \dash\get::index($record, 'value', 'avatar'); ?>" class="avatar mRa10" alt="<?php echo \dash\get::index($record, 'value', 'displayname'); ?>">
      <span class="txtB s0 fs08"><?php echo \dash\get::index($record, 'value', 'displayname'); ?></span>

      <div class="txtRa fs08"><?php echo \dash\fit::mobile(\dash\get::index($record, 'value', 'mobile')); ?></div>

      <nav class="txtRa">
        <a href="<?php echo $urlThis; ?>?user_id=<?php echo \dash\get::index($record, 'value', 'user_id'); ?>" title='<?php echo T_("User tickets"); ?>'><i class="sf-question-circle"></i></a>
        <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo \dash\get::index($record, 'value', 'user_id'); ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a>

      </nav>
  </td>
  <td class="mLa10">
    <div class="msg info2 mRa10 mB0 ovh pA5">
      <div class="txtB">
        <?php echo \dash\get::index($record, 'value', 'title'); ?>
      </div>
    <br>
    <?php echo \dash\get::index($record, 'value', 'content'); ?>

    <small class="floatL">
      <?php echo \dash\fit::date(\dash\get::index($record, 'value', 'datecreated')); ?>
    </small>
    </div>
  </td>
</tr>

<?php
    }//endif
  } //endfor
} // endfor
?>

    </tbody>
  </table>


<?php
}
else
{
?>

  <table class="tbl1 v5 responsive">
    <tbody>

      <?php foreach ($dataTable as $key => $value) {?>

      <tr class="<?php echo \dash\get::index($value, 'rowColor'); if(isset($value['type']) && $value['type'] === 'ticket_note') { echo 'disabled ';}?>" id='msg<?php echo \dash\get::index($value, 'id'); ?>'>
        <td class="collapsing">
          <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" class="avatar mRa10" alt="<?php echo \dash\get::index($value, 'displayname'); ?>">
          <span class="txtB s0 fs08"><?php echo \dash\get::index($value, 'displayname'); ?></span>
          <?php if(\dash\permission::check('supportTicketShowMobile')) {?>

          <div class="txtRa fs08"><?php echo \dash\fit::mobile(\dash\get::index($value, 'mobile')); ?></div>

          <nav class="txtRa">
            <?php if(\dash\permission::check('supportTicketManage')) {?><a href="<?php echo $urlThis; ?>?user_id=<?php echo \dash\get::index($value, 'user_id'); ?>" title='<?php echo T_("User tickets"); ?>'><i class="sf-question-circle"></i></a><?php } //endif ?>
            <?php if(\dash\permission::check('cpUsersView')) {?><a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo \dash\get::index($value, 'user_id'); ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a><?php }//endif ?>

          </nav>
<?php } //endif ?>
        </td>
        <td class="pRa10">
          <div>
            <?php echo nl2br(\dash\get::index($value, 'content')); ?>
          </div>
          <div class="f mT10">
            <?php if(isset($value['file']) && $value['file']) {?>

           <div>
            <a class="badge" href="<?php echo $value['file']; ?>" target="_blank"><?php echo T_("View attachment"); ?></a>
           </div>

            <?php } //endif ?>

           <div class="cauto os fc-mute">
            <small title='<?php echo \dash\fit::date(\dash\get::index($value, 'datecreated')); ?>'><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></small>
                <?php if(\dash\permission::check('supportEditMessage')) {?>

              <a class="fs08 mLa10" href="<?php echo \dash\url::here(); ?>/message/edit?id=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Edit"); ?></a>

                <?php if(isset($value['type']) && $value['type'] === 'ticket_note') {?>

                  <i class="fc-red sf-user-secret"></i>
                <?php } //endif ?>
            <?php } //endif ?>
           </div>
          </div>
        </td>
      </tr>
<?php } //endfor ?>
    </tbody>
  </table>


<?php } //endif ?>


<?php
if(\dash\data::masterTicketDetail_solved())
{
  if(\dash\data::masterTicketDetail_status() === 'answered' || \dash\data::masterTicketDetail_status() === 'awaiting')
  {

?>

  <form method="post">
        <?php \dash\csrf::html(); ?>

    <p class="msg info mB0-f ovh"><?php echo \dash\data::solvedMsg(); ?>
      <input type="hidden" name="TicketFormType" value="changeStatus">
      <button class="btn secondary sm floatRa" name="status" value="close"><?php echo T_("Close ticket"); ?></button>
    </p>
  </form>

<?php
  }//endif
} //endif
?>


</div>