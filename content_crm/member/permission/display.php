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

<?php if(\dash\data::dataRowMember_permission()) {?>
<section class="f" data-option='crm-user-apikey'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("API Key");?></h3>
      <div class="body">
        <p><?php echo T_("By creating an API Key, you will allow this user to access the system through a programming interface.") ?></p>
        <?php if(\dash\data::UserApiKey()) {?>
          <div class="txtB mT10"><?php echo T_("API key") ?></div>
          <div class="msg ltr light">
            <div title="<?php echo T_("Copy") ?>" class="link" data-copy='<?php echo \dash\data::UserApiKey_auth(); ?>' data-copy-msg='<?php echo T_("Copied. Paste into your code!") ?>'>
              <span class="btn"><?php echo T_("Copy") ?></span>
              <code><?php echo substr(\dash\data::UserApiKey_auth(), 0, 8). str_repeat('*', 16). substr(\dash\data::UserApiKey_auth(), 24); ?></code>
            </div>
          </div>
        <?php }// endif ?>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
  <?php if(\dash\data::UserApiKey()) {?>
        <div data-confirm data-data='{"apikey": "revoke"}' class="btn secondary"><?php echo T_("Revoke") ?></div>
  <?php }else{ ?>
        <div data-confirm data-data='{"apikey": "generate"}' class="btn master"><?php echo T_("Generate API Key") ?></div>
  <?php } //endif ?>
    </div>
  </div>
  <?php if(\dash\data::UserApiKey()) {?>
    <footer class="txtRa">

        <div data-confirm data-data='{"apikey": "remove"}' class="btn linkDel"><?php echo T_("Remove") ?></div>
    </footer>
  <?php } //endif ?>
</section>
<?php } //endif ?>