
<div class="msg pain special f align-center fs14">

  <div class="c"><span class="txtB"><?php if(\dash\url::module() === 'ticket') { echo \dash\face::title(); }else { echo T_("Last active tickets"); }?></span>
    <span class="badge rounded pA5-f mLa5">
      <?php
        $sidebarDetail = \dash\data::sidebarDetail();
        if(\dash\request::get('status'))
        {
          if(isset($sidebarDetail[\dash\request::get('status')]))
          {
            echo \dash\fit::number($sidebarDetail[\dash\request::get('status')]);
          }
        }
        else
        {
          echo \dash\fit::number(\dash\data::sidebarDetail_all());
        }
      ?></span></div>
  <div class="cauto os"><a href="<?php echo \dash\url::here(). '/ticket';  echo \dash\data::accessGet(); ?>" class="btn dark sm"><?php echo T_("All Tickets"); ?></a></div>
</div>

<table class="tbl1 v1 cbox fs12" data-scroll>
  <tbody>
<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

foreach ($dataTable as $key => $value)
{
?>

    <tr class="<?php echo \dash\get::index($value, 'rowColor'); ?>">
      <td class=" txtB">
        <?php if(isset($value['parent'])) {?>

        <a href="<?php echo \dash\url::here(). '/ticket'; ?>/show?id=<?php echo \dash\get::index($value, 'parent');  echo \dash\data::accessGetAnd(); ?>#<?php echo \dash\get::index($value, 'id');  if(!\dash\user::id()) {?>&guest=<?php echo \dash\get::index($value, 'code');  } //endif ?>"><span class="badge light mRa5"><?php echo \dash\fit::number(\dash\get::index($value, 'parent')); ?></span>
          <?php echo substr(\dash\get::index($value, 'content'), 0, 60); if(mb_strlen(\dash\get::index($value, 'content')) > 60) { echo '...' ;} ?>
        </a>

        <?php }else{ ?>
        <a href="<?php echo \dash\url::here(). '/ticket'; ?>/show?id=<?php echo \dash\get::index($value, 'id');  echo \dash\data::accessGetAnd(); if(!\dash\user::id()) { echo '&guest='. \dash\get::index($value, 'code');} ?>"><span class="badge light mRa5"><?php echo \dash\fit::number(\dash\get::index($value, 'id')); ?></span> <?php echo substr(\dash\get::index($value, 'content'), 0, 60); if(mb_strlen(\dash\get::index($value, 'content')) > 60) { echo '...' ;} ?></a>
        <?php } // endif ?>

        <?php if(isset($value['tag']) && $value['tag'] && is_array($value['tag'])) {?>

        <div class="mT5 fs12">

          <?php foreach ($value['tag'] as $Tkey => $Tvalue) {?>

            <a class="badge" href="<?php echo \dash\url::here(). '/ticket'; ?>?tag=<?php echo urlencode($Tvalue); ?>"><?php echo $Tvalue; ?></a>

          <?php } // endfor ?>

        </div>

      <?php } //endif ?>

      </td>

      <?php if(false) {?>
      <td class="s0 m0 pRa10"><a href="<?php echo \dash\url::here(). '/ticket'; ?>/show?id=<?php echo \dash\get::index($value, 'id'); echo \dash\data::accessGetAnd(); ?><?php if(!\dash\user::id()) { echo '&guest='. \dash\get::index($value, 'code'); } ?>"><?php echo substr(strip_tags(\dash\get::index($value, 'content')), 0, 60); ?></a>
      </td>
      <?php } //endif ?>

      <?php if(\dash\data::haveSubdomain()) {?>

    <td class="collapsing fs08 s0 ltr">
      <?php if(isset($value['subdomain']) && $value['subdomain']) {?>

      <a href="<?php echo \dash\url::here(). '/ticket'; ?>?access=all&subdomain=<?php echo $value['subdomain']; ?>"><?php echo ucfirst($value['subdomain']); ?></a>

      <?php } //endif ?>
    </td>
  <?php } //endif ?>

      <td class="collapsing s0"><?php if(isset($value['solved']) && $value['solved']) {?><div class="badge success"><?php echo T_("Solved"); ?> <i class="compact sf-check"></i></div><?php }//endif ?></td>

      <td class="collapsing s0"><?php if(isset($value['plus']) && $value['plus']) { echo \dash\fit::number($value['plus']); ?> <i class="compact sf-chat-alt-fill"></i><?php } //endif ?></td>

      <td class="collapsing fs08"><span title='<?php echo T_("Created on"). ' '. \dash\fit::date(\dash\get::index($value, 'datecreated')); ?> <?php if(isset($value['datemodified']) && $value['datemodified']) {?><br><?php echo T_("Last modified on"); ?> <?php echo \dash\fit::date($value['datemodified']); }//endif?>'><?php if(isset($value['datemodified']) && $value['datemodified']) { echo \dash\fit::date_human($value['datemodified']); } else { echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); }?></span></td>

      <td class="collapsing fs08 s0 m0"><?php if(isset($value['status']) && $value['status'] != 'awaiting') {?><i class="compact mRa5 sf-spin-alt fc-green"></i><?php }else{ ?><i class="compact mRa5 sf-asterisk spiny fc-red"></i><?php }  echo T_(ucfirst(\dash\get::index($value, 'status')));  ?></td>

      <?php if(\dash\data::accessMode() !== 'mine') {?>

      <td class="collapsing fs08 txtRa s0">
        <a href="<?php echo \dash\url::here(). '/ticket'; ?>?user=<?php echo \dash\get::index($value, 'user_id'); ?><?php echo \dash\data::accessGetAnd(); ?>">
        <span class="txtB s0"><?php echo \dash\get::index($value, 'displayname'); ?></span>
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" class="avatar mLa10" alt="<?php echo \dash\get::index($value, 'displayname'); if(isset($value['displayname']) && $value['displayname']) {?>"  title="<?php echo $value['displayname']; ?>" <?php } //endif ?>>
        </a>
      </td>

    <?php }//endif ?>

    <td class="collapsing fs08 s0" title2='<?php echo T_("Active in this ticket"); ?>'>
      <?php if(isset($value['user_in_ticket_detail']) && is_array($value['user_in_ticket_detail'])) {?>
        <?php  foreach ($value['user_in_ticket_detail'] as $myvalue)  {?>
          <img src="<?php echo \dash\get::index($myvalue, 'avatar'); ?>" class="avatar mRa5" alt="<?php echo \dash\get::index($myvalue, 'displayname'); ?>" <?php if(isset($myvalue['displayname']) && $value['displayname']) {?> title="<?php echo $myvalue['displayname']; ?>" <?php } //endif ?>>
        <?php } //endfor ?>
      <?php } //endif ?>
      </td>
    </tr>

<?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>



<?php if(\dash\permission::supervisor()) {?>
<ul class="msg fs14 list2">
<?php if(\dash\data::sidebarDetail_all()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=all<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_all()); ?></span><?php echo T_("All"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\data::sidebarDetail_awaiting()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=awaiting<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_awaiting()); ?></span><?php echo T_("Awaiting answer"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\data::sidebarDetail_answered()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=answered<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_answered()); ?></span><?php echo T_("Answered"); ?></a></li>
<?php } //endif ?>

<?php if((\dash\data::sidebarDetail_all() || \dash\data::sidebarDetail_awaiting()) && ((\dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_unsolved()) || \dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_solved())) {?>
<li class="hr"></li>
<?php } //endif ?>

<?php if(\dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_unsolved()) {?>
<?php $haveBeforeLink = true; ?>

      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=unsolved<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_unsolved()); ?></span><?php echo T_("Unsolved"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_solved()) {?>
<?php $haveBeforeLink = true; ?>

      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=solved<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_solved()); ?></span><?php echo T_("Solved"); ?></a></li>
<?php } //endif ?>

<?php if((isset($haveBeforeLink) && $haveBeforeLink) && (\dash\data::sidebarDetail_open() || \dash\data::sidebarDetail_archived())) {?>

<li class="hr"></li>
<?php } //endif ?>

<?php if(\dash\data::sidebarDetail_open()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=open<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_open()); ?></span><?php echo T_("Open tickets"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\data::sidebarDetail_archived()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=archived<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_archived()); ?></span><?php echo T_("Archived"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_trash()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=deleted<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_trash()); ?></span><?php echo T_("Trash"); ?></a></li>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=spam<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 badge"><?php echo \dash\fit::number(\dash\data::sidebarDetail_spam()); ?></span><?php echo T_("Spam"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\permission::check('cpTagSupportEdit')) {?>
  <li><a href="<?php echo \dash\url::here(); ?>/ticket/tags"><i class='fc-mute sf-bug'></i> <?php echo T_("Ticket Topics"); ?></a></li>
<?php } //endif ?>


<?php if(\dash\data::sidebarDetail_tags()) {?>
<li class="hr"></li>
<li>
    <ul>
      <?php foreach (\dash\data::sidebarDetail_tags() as $key => $value)
      {
        if((isset($value['status']) && $value['status'] === 'enable') || \dash\permission::check('cpTagSupportEdit'))
        {
      ?>
          <li>
            <a href="<?php echo \dash\url::here(); ?>/ticket?tag=<?php echo \dash\get::index($value, 'slug'); ?><?php echo \dash\data::accessGetAnd(); ?>">
            <span class="floatLa mRa10 badge fc-mute"> <?php echo \dash\fit::number(\dash\get::index($value, 'usage_count')); ?></span>
            <span class="mRa10 badge rounded <?php if(isset($value['meta']['color'])) {echo $value['meta']['color']; } ?>">&nbsp;</span><?php echo \dash\get::index($value, 'title'); ?></a>
          </li>
      <?php } // endif ?>
    <?php } // endfor ?>
    </ul>
</li>
<?php } //endif ?>
</ul>
<?php }?>

