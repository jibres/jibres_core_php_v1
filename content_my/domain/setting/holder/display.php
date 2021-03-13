<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<form method="post" autocomplete="off" >
  <?php \dash\csrf::html(); ?>
  <div class="avand-md">
    <div class="box">
      <div class="pad">

        <p class="msg info2"><?php echo T_('You can change domain technical and billing holder to another one to allow them to do some action.'); ?></p>
        <label for="iholder"><?php echo T_("Domain Holder"); ?></label>
        <div class="input ltr">
          <input type="text" name="holder" id="iholder" maxlength="15" disabled value="<?php echo \dash\data::domainDetail_holder(); ?>" >
        </div>

        <label for="iadmin"><?php echo T_("Domain Admin"); ?></label>
        <div class="input ltr">
          <input type="text" name="admin" id="iadmin" maxlength="15" disabled value="<?php echo \dash\data::domainDetail_admin(); ?>" >
        </div>

        <label for="itech"><?php echo T_("Domain Technical"); ?></label>
        <div class="input ltr">
          <input type="text" name="tech" id="itech" maxlength="15" value="<?php echo \dash\data::domainDetail_tech(); ?>" >
        </div>

        <label for="ibill"><?php echo T_("Domain Billing"); ?></label>
        <div class="input ltr">
          <input type="text" name="bill" id="ibill" maxlength="15" value="<?php echo \dash\data::domainDetail_bill(); ?>" >
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Update"); ?></button>

      </footer>
    </div>
  </div>
</form>
