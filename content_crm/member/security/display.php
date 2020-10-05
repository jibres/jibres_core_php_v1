


<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">
 <div class="cauto s12 pA5">
    <?php require_once(root. 'content_crm/member/psidebar.php'); ?>

 </div>
 <div class="c s12 pA5">

  <form class="cbox" method="post" autocomplete="off">

    <?php if(\dash\data::permGroup()) {?>


    <div class="mT10">
      <label for="permission"><?php echo T_("Permission"); ?></label>
      <select name="permission" class="select22" id="permission">
        <option value="" readonly><?php echo T_("No permission"); ?></option>
        <option value="0" readonly><?php echo T_("No permission"); ?></option>

        <?php foreach (\dash\data::permGroup() as $key => $value) {?>

          <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowMember_permission() == $key)  { echo 'selected'; }?> > <?php echo T_($value['title']); ?></option>

        <?php } ?>
      </select>
    </div>

  <?php } ?>


    <div class="mTB10">
      <label for="language"><?php echo T_("Default language"); ?></label>
      <select name="language" class="select22" id="language">
        <option value="" readonly><?php echo T_("Select one item"); ?></option>
          <?php foreach (\dash\language::all(true) as $key => $value) {?>

            <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowMember_language() == $key || (!\dash\data::dataRowMember_language() && \dash\language::currentAll() == $key)) {echo 'selected';} ?>><?php echo $value; ?></option>

          <?php } //endfor ?>


      </select>
    </div>


    <label for="username"><?php echo T_("Username"); ?></label>
    <div class="input ltr">
      <input type="text" name="username" id="username" placeholder='<?php echo T_("Username"); ?>' value="<?php echo \dash\data::dataRowMember_username(); ?>" maxlength='40' minlength="1" pattern=".{1,40}" title='<?php echo T_("Enter a valid username from 3 to 40 character"); ?>' autofocus>
    </div>


    <div class="switch1 mT20">
     <input type="checkbox" name="twostep" id="twostep" <?php if(\dash\data::dataRowMember_twostep()) { echo 'checked';} ?>>
     <label for="twostep"></label>
     <label for="twostep"><?php echo T_("Two step verification"); ?></label>
    </div>


    <div class="switch1 mT20">
     <input type="checkbox" name="forceremember" id="forceremember" <?php if(\dash\data::dataRowMember_forceremember()) { echo 'checked';} ?>>
     <label for="forceremember"></label>
     <label for="forceremember"><?php echo T_("Save remember session"); ?></label>
    </div>

    <div class="switch1 mTB0">
      <input type="checkbox" name="sidebar" id="xsidebar" <?php if(\dash\data::dataRowMember_sidebar()) { echo 'checked';} ?>>
      <label for="xsidebar"></label>
      <label for="xsidebar"><?php echo T_("Show sidebar"); ?></label>
    </div>

    <div class="mT10">
    <label for="status"><?php echo T_("Status"); ?></label>
    <select name="status" class="select22" id="status">
      <option value="" readonly><?php echo T_("Select one item"); ?> *</option>
      <option value="active" <?php if(\dash\data::dataRowMember_status() == 'active') { echo 'selected';} ?> ><?php echo T_("Active"); ?></option>
      <option value="awaiting" <?php if(\dash\data::dataRowMember_status() == 'awaiting') { echo 'selected';} ?> ><?php echo T_("Awaiting"); ?></option>
      <option value="deactive" <?php if(\dash\data::dataRowMember_status() == 'deactive') { echo 'selected';} ?> ><?php echo T_("Deactive"); ?></option>
      <option value="removed" <?php if(\dash\data::dataRowMember_status() == 'removed') { echo 'selected';} ?> ><?php echo T_("Removed"); ?></option>
      <option value="filter" <?php if(\dash\data::dataRowMember_status() == 'filter') { echo 'selected';} ?> ><?php echo T_("Filter"); ?></option>
      <option value="unreachable" <?php if(\dash\data::dataRowMember_status() == 'unreachable') { echo 'selected';} ?> ><?php echo T_("Unreachable"); ?></option>
    </select>
  </div>

  <?php if(\dash\permission::check('cpUsersPasswordChange')) {?>

      <label for="password"><?php echo T_("Password"); ?> <small><?php echo T_("Enter to change pass"); ?></small></label>
      <div class="input">
        <input type="password" name="password" id="password" placeholder='<?php if(\dash\data::dataRowMember_password())  { echo T_("Password was set, enter to change it!"); }else{ echo T_("Password not set, enter  to set it!"); }?>' maxlength='50' data-response-realtime autocomplete="new-password">
      </div>
      <div data-response='password' data-response-hide data-response-effect='slide'>
        <label for="repassword"><?php echo T_("Confirm password"); ?> <small class="fc-red">* <?php echo T_("Require to change current password"); ?></small></label>
        <div class="input">
        <input type="password" name="repassword" id="repassword" placeholder='<?php if(\dash\data::dataRowMember_password())  { echo T_("Password was set, enter to change it!"); }else{ echo T_("Password not set, enter  to set it!"); }?>'  maxlength='50'>
      </div>
      </div>
  <?php } ?>


    <button class="btn primary block mT20"><?php echo T_("Save"); ?></button>

  <?php if(\dash\permission::supervisor()) {?>

      <div class="badge mT10 mB10 danger" data-kerkere-icon data-kerkere='.DeleteUserYN'><?php echo T_("Delete user"); ?></div>
      <div class="DeleteUserYN" data-kerkere-content="hide">
        <div class="msg danger">
          <?php echo T_("Are you sure to delete this user?"); ?>
          <span data-confirm data-data='{"deleteuser" : "DeleteUserYN"}' class="badge warn floatL"><?php echo T_("Delete"); ?></span>
        </div>
      </div>
    <?php } ?>
  </form>

  <?php if(\dash\permission::supervisor()) {?>

      <div class="cbox">
        <form method="post">
            <?php if(\dash\data::chatIdList()) {?>

              <div class="msg success2">
              <?php echo T_("User have chatid"); ?>
                <?php foreach (\dash\data::chatIdList() as $key => $value) {?>

                  <br>
                  <span class="badge mLR20"><?php echo \dash\fit::number($key + 1); ?></span><b><?php echo $value['chatid']; ?> </b>
                  <span data-confirm data-data='{"removechatid" : "removechatid", "chatid" : "<?php echo $value['chatid']; ?>"}' class="badge danger floatL"><?php echo T_("Remove chatid"); ?></span>
                <?php } ?>
              </div>

            <?php } ?>

            <input type="hidden" name="setChatid" value="1">
            <div class="input">
              <label class="addon" for="ichatid"><?php echo T_("chatid"); ?> <?php echo T_("Telegram"); ?></label>
              <input type="number" id="ichatid" name="chatid">
              <button class="btn addon primary"><?php echo T_("Add"); ?></button>
            </div>
          </div>
        </form>


    <?php if(\dash\data::androidList()) {?>
      <div class="cbox">
        <form method="post">
            <div class="msg success2">
              <?php echo T_("User have android"); ?>
              <?php foreach (\dash\data::androidList() as $key => $value) {?>
                <span class="badge mLR20"><?php echo \dash\fit::number($key + 1); ?></span><b></b>
              <?php } ?>
            </div>
          </div>
        </form>
    <?php } //endif ?>


    <?php } //endif ?>

  <div class="cbox">

    <h4><?php echo T_("Active sessions"); ?> </h4>


      <?php
      $sessionsList = \dash\data::sessionsList();
      if(!is_array($sessionsList))
      {
        $sessionsList = [];
      }

      foreach ($sessionsList as $key => $row) {

      ?>


      <div class="panel mB10">
        <div class="f align-center pad">
          <div class="cauto s5 pRa10">
            <div class="device72" data-device='<?php echo mb_strtolower(\dash\get::index($row, 'os')); ?>'></div>
          </div>
          <div class="pA5 c s7">
            <div class="mB5"><b><?php echo \dash\get::index($row, 'osName'); ?></b> <?php echo \dash\fit::number(\dash\get::index($row, 'osVer')); ?></div>
            <div class="fc-mute ltr compact font-12"><?php  echo \dash\fit::date_time(\dash\get::index($row, 'datecreated')) ?></div>

            <?php if(isset($row['current_session']) && $row['current_session']) {?>

            <div class="badge success"><?php echo T_("This device"); ?></div>

            <?php }//endif ?>

          </div>
          <div class="pA5 c s12 fs08">
            <div class="mB10"><b><?php echo \dash\get::index($row, 'browser'); ?></b> <?php echo \dash\fit::number(\dash\get::index($row, 'browserVer')); ?></div>
            <div><?php echo \dash\fit::date_human(\dash\get::index($row, 'last')); ?></div>
          </div>
          <div class="pA5 c3 s12">
            <div class="mB5">
              <a target="_blank" href="https://ipgeolocation.io/ip-location/<?php echo \dash\get::index($row, 'ip'); ?>" title='<?php echo T_("Check ip address"); ?>'><?php echo \dash\get::index($row, 'ip'); ?></a>
            </div>
            <div>
              <a class="badge danger" data-confirm data-data='{"id" : "<?php echo \dash\get::index($row, 'id'); ?>", "type": "terminate" <?php echo \dash\utility\hive::get_json(); ?>  }'><?php echo T_("Terminate"); ?></a>
            </div>
          </div>

          <?php if(\dash\permission::supervisor()) {?>

          <div class="c12 fs05 pA5 ovh"><?php echo \dash\get::index($row, 'agent'); ?></div>

          <?php } //endif ?>

        </div>
      </div>
  <?php } //endfor ?>
  </div>

 </div>
</div>
