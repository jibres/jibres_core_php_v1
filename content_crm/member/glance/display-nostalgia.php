
<div class="f justify-center">
  <div class="c6 s12">
    <div class="cbox">
      <?php if(\dash\permission::check('cpUsersEdit')) {?>

        <div class="f">
          <div class="c">
              <a class="btn danger outline block mB20" href="<?php echo \dash\url::this(); ?>/general?id=<?php echo \dash\request::get('id'); ?>"><?php echo T_("Edit"); ?></a>
          </div>

      <?php if(\dash\permission::supervisor()) {?>

          <div class="cauto">
            <a class="btn mLa5 danger  mB20" href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo \dash\request::get('id'); ?>&showlog=1"><?php echo T_("Log"); ?></a>
          </div>

      <?php } // endif ?>

        </div>

      <?php } // endif ?>
      <table class="tbl">
        <thead>
          <tr class="primary">
            <th><?php echo T_("Field"); ?></th>
            <th><?php echo T_("Value"); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (\dash\data::dataRowMember() as $key => $value) {?>

            <?php if(!$value) {continue;} ?>

            <?php if(in_array($key, ['password', 'unit_id', 'detail', 'avatar_raw', 'meta', 'jibres_user_id']))  { continue; }?>

            <?php if($key == 'id') {?>

                <tr>
                  <th><?php echo T_($key); ?></th>
                  <td class="ltr">
                    <?php echo $value; ?>
                    <?php if(\dash\permission::supervisor()) {?>
                      <div title='<?php echo T_("Decode"); ?>' class="badge mLR10"><?php echo \dash\fit::text(\dash\coding::decode($value)); ?></div>
                      <a class="btn" href="<?php echo \dash\url::kingdom(); ?>/enter?userid=<?php echo \dash\coding::decode($value); ?>"><i class="sf-user"></i> <?php echo T_("Enter"); ?></a>
                    <?php } ?>
                  </td>
                </tr>

            <?php }elseif($key == 'mobile') {?>

              <tr class="f-<?php echo $key; ?> positive">
                <th><?php echo T_($key); ?></th>
                <td class="ltr">


                  <a href="tel:<?php echo $value; ?>">
                    <i class="sf-mobile"></i>
                    <?php echo \dash\fit::mobile($value); ?>

                  </a>


                <?php if(\dash\permission::check('cpSmsSend')) {?>

                  <br>
                  <a class="btn" href="<?php echo \dash\url::here(); ?>/sms/send?mobile=<?php echo $value; ?>"><i class="sf-envelope"></i> <?php echo T_("Send SMS"); ?></a>
                <?php }//endif ?>
                <?php if(\dash\permission::supervisor()) {?>

                  <a class="btn" href="<?php echo \dash\url::kingdom(); ?>/enter?mobile=<?php echo $value; ?>"><i class="sf-user"></i> <?php echo T_("Enter"); ?></a>
                <?php }//endif ?>
                </td>
              </tr>

            <?php }else{ ?>

              <tr class="f-<?php echo $key; if(in_array($key, ['username', 'mobile'])) { echo ' positive ';}?>">

                  <th class="collapsing"><?php echo T_($key); ?></th>

                <td>
                <?php if(strpos($key, 'date') !== false) {?>
                  <?php if(in_array($key, ['datecreated', 'datemodified'])) {?>

                  <a href="<?php echo \dash\url::here(); ?>/log?datecreated=<?php echo $value; ?>">
                    <span class="block ltr" title="<?php echo $value; ?>"><i class="sf-calendar"></i> <?php echo \dash\fit::date($value); ?></span>
                  </a>

                  <?php }else{ ?>

                  <span class="block ltr" title="<?php echo $value; ?>"><i class="sf-calendar"></i> <?php echo \dash\fit::date($value); ?></span>

                  <?php } // endif ?>

                <?php }elseif(strpos($key, 'code') !== false || strpos($key, 'id') !== false || strpos($key, 'phone') !== false ) {?>

                  <span class="block ltr"><?php echo \dash\fit::number($value); ?></span>

                <?php }elseif($key === 'website') {?>

                  <a class="block ltr" href="<?php echo $value; ?>"><?php echo $value; ?></a>
                <?php }elseif($key === 'facebook') {?>

                  <a class="block ltr" href="https://facebook.com/<?php echo $value; ?>"><?php echo $value; ?></a>
                <?php }elseif($key === 'twitter') {?>
                  <a class="block ltr" href="https://twitter.com/<?php echo $value; ?>"><?php echo $value; ?></a>
                <?php }elseif($key === 'instagram') {?>
                  <a class="block ltr" href="https://instagram.com/<?php echo $value; ?>"><?php echo $value; ?></a>
                <?php }elseif($key === 'linkedin') {?>
                  <a class="block ltr" href="https://linkedin.com/in/<?php echo $value; ?>"><?php echo $value; ?></a>
                <?php }elseif($key === 'email') {?>
                  <a class="block ltr" href="mailto:<?php echo $value; ?>"><?php echo $value; ?></a>
                <?php }elseif($key === 'avatar') {?>

                  <img src="<?php echo $value; ?>" class="size-we80">

                <?php }else{ ?>
                  <?php echo T_($value); ?>

                <?php }// endif ?>
                </td>
              </tr>
            <?php }//endif ?>

          <?php } //endfor ?>
        </tbody>
      </table>
    </div>


    <?php if(\dash\data::userTelegram()) {?>
    <table class="tbl1 v6 fs12">
      <thead>
        <tr>
          <th><?php echo T_("Telegrams"); ?></th>
          <th><?php echo T_("Username"); ?></th>
          <th><?php echo T_("Join at"); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::userTelegram() as $key => $value) {?>

          <tr>
            <td><a href="<?php echo \dash\url::this(); ?>/security?id=<?php echo \dash\request::get('id'); ?>"><?php echo $value['chatid']; ?></a></td>
            <td><?php echo $value['username']; ?></td>
            <td><?php echo \dash\fit::date_human($value['datecreated']); ?></td>
          </tr>
        <?php } //endfor ?>
      </tbody>
    </table>
    <?php } //enndif ?>


    <?php if(\dash\data::userAndroid()) {?>
    <table class="tbl1 v6 fs12">
      <thead>
        <tr>
          <th><?php echo T_("Android"); ?></th>
          <th><?php echo T_("Version"); ?></th>
          <th><?php echo T_("Manufacturer"); ?></th>
          <th><?php echo T_("Serial"); ?></th>
          <th><?php echo T_("Join at"); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::userAndroid() as $key => $value) {?>
          <tr>
            <td><a href="<?php echo \dash\url::this(); ?>/security?id=<?php echo \dash\request::get('id'); ?>"><?php echo $value['model']; ?></a></td>
            <td><?php echo $value['version']; ?></td>
            <td><?php echo $value['manufacturer']; ?></td>
            <td><?php echo $value['serial']; ?></td>
            <td><?php echo \dash\fit::date_human($value['datecreated']); ?></td>

          </tr>
        <?php }//endfor ?>
      </tbody>
    </table>
    <?php }//endif ?>





  </div>


<?php if(\dash\permission::supervisor() && \dash\request::get('showlog') && is_array(\dash\data::showUserLog())) {?>


  <div class="c3">
    <div class="cbox mLa5">
      <a class="btn danger2 block mB10" href="<?php echo \dash\url::this(); ?>/security?id=<?php echo \dash\request::get('id'); ?>"><?php echo T_("Security"); ?></a>
      <?php
        $myCountI = 0;
      ?>


      <?php foreach (\dash\data::showUserLog() as $key => $value) {?>

        <?php $myCountI += intval($value['count']); ?>


      <?php if(isset($value['link']) && $value['link']) {?>

        <a href="<?php echo $value['link']; ?>">

      <?php } //endif ?>

        <div class="msg <?php if(isset($value['link']) && $value['link']) { echo "primary outline";}?>">
          <span><?php echo T_($key); ?></span>
          <span class="floatL txtB"><?php echo \dash\fit::number($value['count']); ?></span>
        </div>

      <?php if(isset($value['link']) && $value['link']) {?>
      </a>
      <?php } ?>

      <?php } //endfor ?>

      <?php if(!$myCountI) {?>

        <div class="msg danger">
          <?php echo T_("Are you sure to delete this user?"); ?>
          <span data-confirm data-data='{"deleteuser" : "DeleteUserYN"}' class="badge warn floatL"><?php echo T_("Delete"); ?></span>
        </div>
      <?php } ?>
    </div>
  </div>

  <?php } //endif ?>
</div>
