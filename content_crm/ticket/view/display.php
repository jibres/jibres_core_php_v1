<?php $data = \dash\data::dataRow(); ?>
<?php $customer_mode = \dash\temp::get('customer_mode'); ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8 c-lg-9 c-xxl-10">
    <nav class="items long">
      <ul>
        <li>
      <?php if($customer_mode && !\dash\data::dataRow_title()) {/*Not display title*/}else{?>
          <a class="f item" <?php if(!$customer_mode) {?> href="<?php echo \dash\url::this(). '/subject?id='. \dash\request::get('id') ?>"<?php }// endif ?>>
<?php
if(\dash\data::dataRow_title())
{
  echo '<div class="key txtB">'. \dash\data::dataRow_title(). '</div>';
}
else
{
  echo '<div class="key fc-mute">'. T_("Without title"). '</div>';
}
?>
            <div class="value"><?php echo T_("Subject") ?></div>
            <div class="go detail <?php if(\dash\data::dataRow_title()){ echo 'ok';} ?>"></div>
          </a>
      <?php } //endif ?>
        </li>
      </ul>
    </nav>

    <?php require_once "display-chat.php"; ?>
    <?php require_once "display-append.php"; ?>
  </div>
  <aside class="c-xs-12 c-sm-12 c-md-4 c-lg-3 c-xxl-2 ticketSidebar">

    <div class="hero">
  <?php if(!a($data, 'user_id')) {?>
      <img src="<?php echo \dash\fit::img(\dash\data::dataRow_avatar(), 220); ?>" alt="Guest User">
  <?php }else{ ?>
      <img src="<?php echo \dash\fit::img(\dash\data::dataRow_avatar(), 220); ?>" alt='<?php echo \dash\data::dataRow_displayname();?>'>
      <h3><?php echo \dash\data::dataRow_displayname();?></h3>
  <?php } ?>
    </div>

    <nav class="items long">
      <ul>
        <li>
          <div class="f item" data-copy="<?php echo \dash\url::kingdom(); ?>/!<?php echo \dash\data::dataRow_id() ?>">
            <div class="key"><?php echo T_("Ticket ID") ?></div>
            <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
            <i class="sf-pound"></i>
          </div>
        </li>

      </ul>
    </nav>


    <nav class="items long">
      <ul>
        <li>
          <div class="f item">
            <i class="sf-date"></i>
            <div class="key"><?php echo T_("Submit Date") ?></div>
            <time class="value" datetime="<?php echo \dash\data::dataRow_datecreated(); ?>"><?php echo \dash\fit::date_time(\dash\data::dataRow_datecreated()); ?></time>
          </div>
        </li>
        <li>
          <div class="f item">
            <i class="sf-clock"></i>
            <time class="key" datetime="<?php echo \dash\data::dataRow_datecreated(); ?>"><?php echo \dash\fit::date_human(\dash\data::dataRow_datecreated()); ?></time>
          </div>
        </li>
        <li>
          <div class="f item">
            <i class="sf-cardiac-pulse"></i>
            <div class="key"><?php echo T_("First Answer") ?></div>
            <time class="value "><?php echo \dash\fit::date_human(\dash\data::dataRow_datecreated()); ?></time>
          </div>
        </li>
      </ul>
    </nav>


    <nav class="items long">
      <ul>
        <li>
          <a class="f item" href="tel:+<?php echo \dash\data::dataRow_mobile();?>">
            <i class="sf-mobile"></i>
            <div class="key"><?php echo T_("Mobile") ?></div>
            <div class="value mobile"><?php echo \dash\fit::mobile(\dash\data::dataRow_mobile()); ?></div>
          </a>
        </li>
        <li>
          <div class="f item" data-copy='<?php echo \dash\fit::mobile(\dash\data::dataRow_email()); ?>'>
            <i class="sf-at"></i>
            <div class="key"><?php echo T_("Email") ?></div>
            <div class="value"><?php echo \dash\fit::mobile(\dash\data::dataRow_email()); ?></div>
          </div>
        </li>
        <li>
          <a class="f item" href="https://t.me/<?php echo \dash\data::dataRow_telegram(); ?>">
            <i class="sf-paper-plane"></i>
            <div class="key"><?php echo T_("Telegram") ?></div>
            <div class="value"><?php echo \dash\data::dataRow_telegram(); ?></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <a class="f item" <?php if(!$customer_mode) {?> href="<?php echo \dash\face::btnSetting() ?>"<?php } //endif ?>>
            <div class="key"><?php echo T_("Status") ?></div>
            <div class="value txtB"><?php echo T_(\dash\data::dataRow_status()); ?></div>
            <div class="go <?php echo \dash\data::dataRow_statuclass(); ?>"></div>
          </a>
        </li>
        <?php if(!$customer_mode) {?>
        <li>
          <a class="f item" href="<?php echo \dash\face::btnSetting(); ?>">
            <div class="key"><?php echo T_("Solved status") ?></div>
            <div class="value txtB"><?php if(\dash\data::dataRow_solved()){echo T_("The problem is solved");}else{echo T_("The problem is not solved");} ?></div>
            <div class="go <?php if(\dash\data::dataRow_solved()){echo 'check ok';}else{echo 'times nok';} ?>"></div>
          </a>
        </li>
      <?php } // endif ?>
        <?php if(\dash\data::dataRow_base()) {?>
        <li class="">
          <a class="f item" href='<?php echo \dash\url::this(). '/view?id='. \dash\data::dataRow_base(); ?>'>
            <div class="key"><?php echo T_("This ticket is branch of another ticket"); ?></div>
            <div class="value"><?php echo T_("View base ticket"); ?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php }// endif ?>
      </ul>
    </nav>


    <nav class="items long">
      <ul>
        <?php if(\dash\data::dataRow_ip()) {?>
        <li>
          <a target="_blank" class="f item" href="<?php echo \dash\url::jibres_domain(). 'ip/'. \dash\utility\convert::to_en_number(\dash\data::dataRow_prettyip()) ?>">
            <div class="key"><?php echo T_("IP") ?></div>
            <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_prettyip()); ?></div>
            <div class="go external"></div>
          </a>
        </li>
      <?php } //endif ?>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <a class="f item" href='<?php echo \dash\url::this(). '/view?id='. \dash\data::dataRow_base(); ?>'>
            <div class="key"><?php echo T_("This ticket is branch of another ticket"); ?></div>
            <div class="value"><?php echo T_("Ticket Count"); ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

  </aside>
</div>

