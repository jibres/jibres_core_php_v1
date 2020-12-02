<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<section class="f" data-option='crm-user-permission'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change Permission");?></h3>
      <div class="body">
        <p><?php echo T_("Set the required permissions for your staff to give them access to your business admin panel. The types of permissions that you grant varies based on the needs of your staff members.") ?></p>
        <p><?php echo T_("When you assign full permissions to a staff member, they can access all of the functions that are available in your Jibres admin, with the exception of those functions that require store owner access.") ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      	<select name="permission" class="select22" id="permission">
			<option value="" readonly><?php echo T_("No permission"); ?></option>
			<option value="admin" <?php if(\dash\data::dataRowMember_permission() == 'admin')  { echo 'selected'; }?>><?php echo T_("Administrator"); ?></option>
			<?php if(\dash\data::permGroup()) {?>
				<?php foreach (\dash\data::permGroup() as $key => $value) {?>
					<option value="<?php echo $value; ?>" <?php if(\dash\data::dataRowMember_permission() == $value)  { echo 'selected'; }?> > <?php echo $value; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
    </div>
  </form>
</section>