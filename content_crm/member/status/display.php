<?php require_once(root. 'content_crm/member/userDetail.php'); ?>


<?php if(\dash\data::dataRowMember_status() !== 'ban' && \dash\data::dataRowMember_status() !== 'removed') {?>
<section class="f" data-option='crm-user-status'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change user status");?></h3>
      <div class="body">
        <p><?php echo T_("You can change user status manually.") ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <div>
      	<select class="select22" name="status">
      		<option value="active" <?php if(\dash\data::dataRowMember_status() === 'active') {echo 'selected';} ?>><?php echo T_('Active') ?></option>
      		<option value="awaiting" <?php if(\dash\data::dataRowMember_status() === 'awaiting') {echo 'selected';} ?>><?php echo T_('Unverify') ?></option>
      		<option value="deactive" <?php if(\dash\data::dataRowMember_status() === 'deactive') {echo 'selected';} ?>><?php echo T_('Deactive') ?></option>
      		<option value="block" <?php if(\dash\data::dataRowMember_status() === 'block') {echo 'selected';} ?>><?php echo T_('Block') ?></option>
      		<?php if(\dash\data::dataRowMember_status() === 'unreachable') {?>
      			<option value="unreachable" <?php if(\dash\data::dataRowMember_status() === 'unreachable') {echo 'selected';} ?>><?php echo T_('unreachable') ?></option>
      		<?php } //endif ?>

      		<?php if(\dash\data::dataRowMember_status() === 'filter') {?>
      			<option value="filter" <?php if(\dash\data::dataRowMember_status() === 'filter') {echo 'selected';} ?>><?php echo T_('filter') ?></option>
      		<?php } //endif ?>
      	</select>
      </div>
    </div>
  </form>
</section>
<?php } //endif ?>

<?php if(\dash\data::dataRowMember_status() === 'ban') {?>

<section class="f" data-option='crm-user-ban'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("User banned");?></h3>
      <div class="body">
        <p><?php echo T_("The user is banned") ?></p>
		<?php if(\dash\data::dataRowMember_ban_expire()) {?>
			<p><?php echo T_("The ban was expire on") ?> <b><?php echo \dash\fit::date_time(\dash\data::dataRowMember_ban_expire()) ?></b></p>
		<?php } // endif ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <div>
      	<div class="btn warn" data-confirm data-data='{"resetban": "resetban"}'><?php echo T_("Reset user") ?></div>
      </div>
    </div>
  </form>
</section>
<?php } //endif ?>


<section class="f" data-option='crm-user-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Remove user");?></h3>
      <div class="body">
		<?php if(\dash\data::dataRowMember_status() === 'removed') {?>
        <p><?php echo T_("The user was removed") ?></p>
		<?php }else{ ?>
        <p><?php echo T_("Remove user") ?></p>
		<?php } //endif ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <div>
		<?php if(\dash\data::dataRowMember_status() === 'removed') {?>
      		<div class="btn primary" data-confirm data-data='{"status": "awaiting"}'><?php echo T_("Restore user") ?></div>
		<?php }else{ ?>
      		<div class="btn danger" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove user") ?></div>
		<?php } //endif ?>
      </div>
    </div>
  </form>
</section>
