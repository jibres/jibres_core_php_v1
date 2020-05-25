


<div class="f">
  <div class="c8 s12 pRa10">
    <?php

      require_once ('chatList.php');

      if(\dash\permission::check('supportTicketAnswer') || \dash\data::masterTicketDetail_status() !== 'spam')
      {
        require_once ( __DIR__.'/../addForm.php');
      }
    ?>

  </div>

  <div class="c4 s12">
    <div class="cbox ovh">

        <div class="f fc-mute mB20 fs09">
          <div class="c fs08"><?php echo T_("Current Time"); ?></div>
          <div class="cauto os"><?php echo \dash\fit::date(date("Y-m-d")). ' '. \dash\fit::text(date("H:i")); ?></div>
        </div>

        <?php if(\dash\data::masterTicketDetail_ip()) {?>

        <div class="f fc-mute mB20 fs09">
          <div class="c fs08"><?php echo T_("IP"); ?></div>
          <div class="cauto os"><a target="_blank" href="<?php echo \dash\url\kingdom(); ?> /ip/<?php echo \dash\data::masterTicketDetail_ip(); ?>"><?php echo \dash\data::masterTicketDetail_prettyip(); ?></a></div>
        </div>
        <?php } //endif ?>

<?php if(\dash\data::masterTicketDetail_status() === 'awaiting' || \dash\data::masterTicketDetail_status() === 'answered') {?>
  <?php if(\dash\permission::check('supportTicketClose')) {?>

      <div class="fs08">
        <p><?php echo T_("If your problem is solved or do not need to track, please close this ticket by press below bottom."); ?> <?php echo T_("You can open it anytime you need."); ?></p>
      </div>
      <form method="post">
            <?php \dash\utility\hive::html(); ?>
        <input type="hidden" name="TicketFormType" value="changeStatus">
        <button class="btn block mTB10 secondary" name="status" value="close"><?php echo T_("Close ticket"); ?></button>

        <?php if(\dash\permission::supervisor()) {?>
        <button class="btn floatRa danger xs" name="status" value="spam"><?php echo T_("Spam"); ?></button>
        <?php } //endif ?>
      </form>

  <?php } // endif ?>

<?php }elseif(\dash\data::masterTicketDetail_status() === 'close') {?>

  <?php if(\dash\permission::check('supportTicketDelete')) {?>

      <div class="fs08">
        <p><?php echo T_("This ticket is closed."); ?> <?php echo T_("You can open it anytime you need."); ?> <?php echo T_("Also you can delete it if you do not need it."); ?></p>
      </div>
      <form method="post">
            <?php \dash\utility\hive::html(); ?>
        <input type="hidden" name="TicketFormType" value="changeStatus">
        <button class="btn block sm mTB10 danger outline" name="status" value="deleted"><?php echo T_("Delete ticket"); ?></button>
        <button class="btn block lg mTB10 success" name="status" value="awaiting"><?php echo T_("Open it again"); ?></button>
      </form>
  <?php } //endif ?>

<?php }elseif(\dash\data::masterTicketDetail_status() === 'deleted') {?>

  <?php if(\dash\permission::check('supportTicketReOpen')) {?>

      <div class="fs08">
        <p><?php echo T_("This is deleted ticket."); ?> <?php echo T_("You can change it to close condition if need to save it in history!"); ?></p>
      </div>
      <form method="post">
            <?php \dash\utility\hive::html(); ?>
        <input type="hidden" name="TicketFormType" value="changeStatus">
        <button class="btn block mTB10 secondary" name="status" value="close"><?php echo T_("Close ticket"); ?></button>
      </form>

  <?php if(\dash\permission::check('supportTicketAnswer')) {?>

      <form method="post">
            <?php \dash\utility\hive::html(); ?>
        <input type="hidden" name="TicketFormType" value="changeStatus">
        <button class="btn block mTB10 danger" name="status" value="spam"><?php echo T_("Spam"); ?></button>
      </form>
  <?php } //endif ?>

  <?php } //endif ?>

<?php }elseif(\dash\data::masterTicketDetail_status() === 'spam') {?>

      <p class="fs08 msg danger txtC txtB">
        <?php echo T_("Spam"); ?>
      </p>

    <?php if(\dash\permission::check('supportTicketAnswer')) {?>

        <form method="post">
            <?php \dash\utility\hive::html(); ?>
          <input type="hidden" name="TicketFormType" value="changeStatus">
          <button class="btn primary floatRa xs" name="status" value="deleted"><?php echo T_("Not spam"); ?></button>
        </form>

    <?php } //endif ?>

<?php } // endif ?>
    </div>


<?php if(!in_array(\dash\data::masterTicketDetail_status(), ['awaiting', 'spam', 'deleted']) && \dash\permission::check('supportTicketAnswer')) {?>

    <div class="cbox">
      <?php if(\dash\data::masterTicketDetail_solved()) {?>

      <div class="fs08">
        <p><?php echo T_("If your problem is not solved yet, please set this ticket as unsolved"); ?></p>
      </div>
      <form method="post">
            <?php \dash\utility\hive::html(); ?>
        <input type="hidden" name="TicketFormSolved" value="solvedForm">
        <button class="btn block mTB10 warn" name="solved" value="0"><?php echo T_("Un Solved ticket"); ?></button>
      </form>

      <?php }else{ ?>

      <div class="fs08">
        <p><?php echo T_("If your problem is solved, please set this ticket as solved"); ?></p>
      </div>
      <form method="post">
            <?php \dash\utility\hive::html(); ?>
        <input type="hidden" name="TicketFormSolved" value="solvedForm">
        <button class="btn block mTB10 success" name="solved" value="1"><?php echo T_("Solved ticket"); ?></button>
      </form>
      <?php } //endif ?>
    </div>
<?php } //endif ?>


    <div class="cbox">
      <h3><?php echo T_("Notification procedures"); ?></h3>
      <div>
        <div class="switch1">
         <input type="checkbox" disabled id="notifMobile" <?php if(\dash\data::masterTicketDetail_mobile()) { echo "checked";} ?> >
         <label for="notifMobile"></label>
         <label for="notifMobile"><?php echo T_("Mobile"); ?></label>
         <?php if(\dash\data::masterTicketDetail_mobile()) {?>

          <label class="floatRa mT10 ltr"><a href="tel:00<?php echo \dash\data::masterTicketDetail_mobile(); ?>"><?php echo \dash\fit::mobile(\dash\data::masterTicketDetail_mobile()); ?></a></label>

          <?php }else{ ?>

          <label class="fc-mute">-</label>

         <?php } //endif ?>

        </div>


<?php if(\dash\data::tgBot()) {?>

        <div class="switch1">
         <input type="checkbox" disabled id="notifTg" <?php if(\dash\data::uaseTelegram_chatid()) { echo 'checked'; }?> >
         <label for="notifTg"></label>
         <label for="notifTg"><?php echo T_("Telegram"); ?></label>

    <?php if(\dash\data::uaseTelegram_username()) {?>

         <label class="floatRa mT10 ltr"><a href="https://t.me/<?php echo \dash\data::uaseTelegram_username(); ?>" target="_blank">@<?php echo substr(\dash\data::uaseTelegram_username(), 0, 15); ?></a></label>

    <?php }elseif(\dash\data::uaseTelegram_firstname()) {?>


         <label class="floatRa mT10 ltr" title='<?php echo T_("First name"); ?>'><?php echo substr(\dash\data::uaseTelegram_firstname(), 0, 15); ?></label>

    <?php }elseif(\dash\data::uaseTelegram_chatid()) {?>

         <label class="floatRa mT10 ltr"><small class="fc-mute"><?php echo T_("Without name"); ?></small></label>

    <?php }else{ ?>

         <label class="floatRa mT10 ltr"><a href="https://t.me/<?php echo \dash\data::tgBot(); ?>?start=sync" target="_blank">@<?php echo \dash\data::tgBot(); ?></a></label>

    <?php } //endif ?>

        </div>

    <?php if(!\dash\data::uaseTelegram_username()) {?>


        <p class="msg pA5-f info2 fs08"><?php echo T_("Do you know you can connect your account with our Telegram bot"); ?> <a href="https://t.me/<?php echo \dash\data::tgBot(); ?>?start=sync" target="_blank">@<?php echo \dash\data::tgBot(); ?></a>.<br><?php echo T_("Just need to start bot in Telegram and sync your account via /sync."); ?></p>

    <?php } //endif ?>

<?php } //endif ?>

        <div class="input fs08" title='<?php echo T_("Short link"); ?>'>
          <input type="text" id="shortLink" class="ltr txtL" value="<?php echo \dash\url::base(); ?>/!<?php echo \dash\data::masterTicketDetail_id(); ?>" readonly>
          <div class="addon btn" data-copy='#shortLink'><span class="sf-link pRa5"></span> <?php echo T_("Short link"); ?></div>
        </div>

      </div>
    </div>




<?php if(!in_array(\dash\data::masterTicketDetail_status(), ['deleted', 'spam'])) {?>

  <?php if(\dash\permission::check('supportTicketManage') && \dash\permission::check('supportTicketAssignTag')) {?>

      <div class="cbox">
        <form method="post">
              <?php \dash\utility\hive::html(); ?>

          <?php if(\dash\permission::check('supportTicketAssignTag')) {?>


            <?php

            $myID             = \dash\coding::encode(\dash\request::get('id'));
            $myTag            = \dash\app\term::load_tag_html(["post_id" => $myID , "title" => true,  "type" => "support_tag", "related" => "tickets"]);

            ?>

            <div class="tagDetector">



              <div class="input mB10 hide">
                <input type="text" class="input tagVals" name="tag" value="<?php if(is_array($myTag)) { echo implode(',', $myTag) ; }?>" id="tagValues" placeholder='<?php echo T_("Tag"); ?>'>
              </div>

              <datalist id="taglist">


                <?php

                if(isset($myTag) && is_array($myTag))
                {
                  foreach ($myTag as $key => $value)
                  {
                    echo '<option value="'. \dash\get::index($value, 'title'). '">';
                  }
                }
                ?>

              </datalist>

              <div class="input" title='<?php echo T_("Add tag manually to link tickets togethers"); ?>'>
                <input type="text" list="taglist" class="tagInput" placeholder='<?php echo T_("Tag keywords..."); ?>'>
                <button class="addon tagAdd">+</button>
              </div>
              <div class="tagBox"></div>
            </div>

          <?php } //endif ?>
          <button class="btn block mTB10 primary"  name="TicketFormType" value="tag"><?php echo T_("Save tag"); ?></button>
        </form>
      </div>
  <?php } //endif ?>
<?php } //endif ?>




  </div>
</div>
