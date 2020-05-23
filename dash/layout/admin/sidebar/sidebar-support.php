

<li>
  <a href="<?php echo \dash\url::here(); ?>/ticket<?php echo \dash\data::accessGet(); ?>"><i class="sf-question-circle"></i><?php echo T_("Tickets"); ?></a>

    <ul>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket/add<?php echo \dash\data::accessGet(); ?>"><i class="floatLa mRa10 fc-mute sf-plus"></i><?php echo T_("New Ticket"); ?></a></li>
<?php if(\dash\data::sidebarDetail_all()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=all<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_all()); ?></span><?php echo T_("All"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\data::sidebarDetail_awaiting()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=awaiting<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_awaiting()); ?></span><?php echo T_("Awaiting answer"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\data::sidebarDetail_answered()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=answered<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_answered()); ?></span><?php echo T_("Answered"); ?></a></li>
<?php } //endif ?>

<?php if((\dash\data::sidebarDetail_all() || \dash\data::sidebarDetail_awaiting()) && ((\dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_unsolved()) || \dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_solved())) {?>
<li class="hr"></li>
<?php } //endif ?>

<?php if(\dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_unsolved()) {?>
<?php $haveBeforeLink = true; ?>

      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=unsolved<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_unsolved()); ?></span><?php echo T_("Unsolved"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_solved()) {?>
<?php $haveBeforeLink = true; ?>

      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=solved<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_solved()); ?></span><?php echo T_("Solved"); ?></a></li>
<?php } //endif ?>

<?php if((isset($haveBeforeLink) && $haveBeforeLink) && (\dash\data::sidebarDetail_open() || \dash\data::sidebarDetail_archived())) {?>

<li class="hr"></li>
<?php } //endif ?>

<?php if(\dash\data::sidebarDetail_open()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=open<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_open()); ?></span><?php echo T_("Open tickets"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\data::sidebarDetail_archived()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=archived<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_archived()); ?></span><?php echo T_("Archived"); ?></a></li>
<?php } //endif ?>

<?php if(\dash\permission::check('supportTicketAnswer') && \dash\data::sidebarDetail_trash()) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=deleted<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_trash()); ?></span><?php echo T_("Trash"); ?></a></li>
      <li><a href="<?php echo \dash\url::here(); ?>/ticket?status=spam<?php echo \dash\data::accessGetAnd(); ?>"><span class="floatLa mRa10 fc-mute badge dark"><?php echo \dash\fit::number(\dash\data::sidebarDetail_spam()); ?></span><?php echo T_("Spam"); ?></a></li>
<?php } //endif ?>
    </ul>
</li>

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
            <span class="floatLa mRa10 badge dark fc-mute"> <?php echo \dash\fit::number(\dash\get::index($value, 'usage_count')); ?></span>
            <span class="mRa10 badge rounded <?php if(isset($value['meta']['color'])) {echo $value['meta']['color']; } ?>">&nbsp;</span><?php echo \dash\get::index($value, 'title'); ?></a>
          </li>
      <?php } // endif ?>
    <?php } // endfor ?>
    </ul>
</li>
<?php } //endif ?>