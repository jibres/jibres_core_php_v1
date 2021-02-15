<?php

$data = \dash\data::dataRow();

$customer_mode = \dash\temp::get('customer_mode');

$liveMode = \dash\url::current();
if(\dash\request::get('id'))
{
  $liveMode .= '?live=1&id='. \dash\request::get('id');
}

if($customer_mode)
{
  echo '<div class="row ticketPage" data-smile-live='. $liveMode. '>'  ;

    echo '<div class="c-xs-12 c-sm-12">';
      require_once "display-append.php";
    echo '</div>';

    echo '<div class="c-xs-12 c-sm-12">';
      require_once "display-chat.php";
    echo '</div>';

  echo '</div>';
  return;
}

?>


<div class="row ticketPage" data-smile-live='<?php echo $liveMode; ?>'>
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
    <?php if(in_array(\dash\data::dataRow_status(), ['close', 'deleted', 'spam'])) {?>
      <nav class="items long">
      <ul>
        <li>
          <div class="f item" data-kerkere='.showAddAnswer'>
          <div class="key"><?php echo T_("Add answer") ?></div>
            <div class="go plus"></div>
          </a>
        </li>
      </ul>
    </nav>
    <div class="showAddAnswer" data-kerkere-content='hide'>
      <?php require_once "display-append.php"; ?>
    </div>
    <?php }else{ ?>
    <?php require_once "display-append.php"; ?>
    <?php } //endif ?>
    <?php require_once "display-chat.php"; ?>
  </div>
  <aside class="c-xs-12 c-sm-12 c-md-4 c-lg-3 c-xxl-2 ticketSidebar">

    <a <?php if(a($data, 'user_id')) {echo "href='".\dash\url::kingdom(). '/crm/member/glance?id='. \dash\data::dataRow_user_id()."'"; } //endif ?> class="hero">
  <?php if(!a($data, 'user_id')) {?>
      <img src="<?php echo \dash\fit::img(\dash\data::dataRow_avatar(), 220); ?>" alt="Guest User">
  <?php }else{ ?>
      <img src="<?php echo \dash\fit::img(\dash\data::dataRow_avatar(), 220); ?>" alt='<?php echo \dash\data::dataRow_displayname();?>'>
      <h3><?php echo \dash\data::dataRow_displayname();?></h3>
  <?php } ?>
    </a>

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
      <?php if(\dash\data::dataRow_base()) {?>
        <li class="">
          <a class="f item" href='<?php echo \dash\url::this(). '/view?id='. \dash\data::dataRow_base(); ?>'>
            <i class="sf-asterisk fc-red"></i>
            <div class="key"><?php echo T_("Separated from"); ?></div>
            <div class="value"><?php echo T_("Ticket"). ' '. \dash\data::dataRow_base(); ?></div>
          </a>
        </li>
      <?php }// endif ?>
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
            <div class="key"></div>
            <div class="value"><?php echo \dash\fit::date_human(\dash\data::dataRow_datecreated()); ?></div>
          </div>
        </li>
        <?php if(\dash\data::dataRow_answertime()) {?>
        <li>
          <div class="f item">
            <i class="sf-cardiac-pulse"></i>
            <div class="key"><?php echo T_("First Answer") ?></div>
            <div class="value "><?php echo \dash\utility\human::time(\dash\data::dataRow_answertime(), true); ?></div>
          </div>
        </li>
      <?php } //endif ?>
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
        <?php if(\dash\data::dataRow_useremail()){ ?>
        <li>
          <div class="f item" data-copy='<?php echo \dash\data::dataRow_useremail(); ?>'>
            <i class="sf-at"></i>
            <div class="key"><?php echo T_("Email") ?></div>
            <div class="value"><?php echo \dash\data::dataRow_useremail(); ?></div>
          </div>
        </li>
      <?php } //endif ?>
        <?php if(\dash\data::dataRow_usertelegram()){ ?>
        <li>
          <a class="f item" href="https://t.me/<?php echo \dash\data::dataRow_usertelegram(); ?>">
            <i class="sf-paper-plane"></i>
            <div class="key"><?php echo T_("Telegram") ?></div>
            <div class="value txtL ltr"><?php echo \dash\data::dataRow_usertelegram(); ?></div>
          </a>
        </li>
      <?php } //endif ?>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <?php if($customer_mode) {?>
        <li>
          <div class="f item">
            <i class="sf-chat-alt-fill"></i>
            <div class="key"><?php echo T_("Status") ?></div>
            <div class="value txtB"><?php echo T_(\dash\data::dataRow_status() === 'close' ? 'archive' : \dash\data::dataRow_status()); ?></div>
            <div class="go <?php echo \dash\data::dataRow_statuclass(); ?>"></div>
          </div>
        </li>
      <?php }else{ ?>
          <?php if(a(\dash\data::conversation(), 0, 'answercount') === 0 && \dash\data::dataRow_status() === 'awaiting') {?>
            <li>
              <div class="f item"
              data-confirm
              data-data='{"setstatus": "set", "status": "spam"}'
              data-title="<?php echo T_("Report as spam"); ?>">
                <i class="sf-ban fc-red"></i>
                <div class="key"><?php echo T_("Is spam?") ?></div>
                <div class="go"></div>
              </div>
          </li>
          <?php }else{ ?>
            <li>
              <div class="f item">
                <i class="sf-chat-alt-fill"></i>
                <div class="key"><?php echo T_("Status") ?></div>
                <div class="value txtB"><?php echo T_(\dash\data::dataRow_status() === 'close' ? 'archive' : \dash\data::dataRow_status()); ?></div>
                <div class="go <?php echo \dash\data::dataRow_statuclass(); ?>"></div>
              </div>
            </li>
          <?php if(\dash\data::dataRow_status() !== 'close' && \dash\data::dataRow_status() !== 'deleted') {?>
            <li>


              <div class="f item"
              data-confirm
              data-data='{"setstatus": "set", "status": "close"}'
              data-title="<?php echo T_("Do you want to archive this ticket?"); ?>">
                <i class="sf-archive fc-orange"></i>
                <div class="key"><?php echo T_("Set ticket as archive") ?></div>
                <div class="go"></div>
              </div>
          </li>
        <?php } //endif ?>
        <?php if(\dash\data::dataRow_status() === 'close') {?>
            <li>
              <div class="f item"
              data-confirm
              data-data='{"setstatus": "set", "status": "deleted"}'
              data-title="<?php echo T_("Do you want to delete this ticket?"); ?>">
                <i class="sf-trash fc-red"></i>
                <div class="key"><?php echo T_("Remove ticket") ?></div>
                <div class="go"></div>
              </div>
          </li>
        <?php } //endif ?>
          <?php } //endif ?>
        <li>
          <div class="f item"
          data-confirm
          data-data='{"setsolved": "set", "solved": "<?php echo intval(\dash\data::dataRow_solved()); ?>"}'
          data-title="<?php if(\dash\data::dataRow_solved()) {echo T_("If your problem is not solved yet, please set this ticket as unsolved");}else{echo T_("If your problem is solved, please set this ticket as solved. \n This will help you understand how many of your customers' requests are successfully solved");} ?>">
            <i class="sf-<?php if(\dash\data::dataRow_solved()){echo 'heart ok';}else{echo 'heart-o';} ?>"></i>
            <div class="key"><?php echo T_("Solved?") ?></div>
            <div class="value txtB"><?php if(\dash\data::dataRow_solved()){echo T_("Yes");}else{echo T_("No");} ?></div>
          </div>
        </li>
      <?php } // endif ?>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <?php if(a(\dash\data::conversation(), 0, 'messagecount')) {?>
        <li>
          <div class="f item">
            <i class="sf-comment"></i>
            <div class="key"><?php echo T_("Message Count"); ?></div>
            <div class="value"><?php echo \dash\fit::number(a(\dash\data::conversation(), 0, 'messagecount')); ?></div>
          </div>
        </li>
      <?php } //endif ?>
        <?php if(a(\dash\data::conversation(), 0, 'answercount')) {?>
        <li>
          <div class="f item">
            <i class="sf-comments-o"></i>
            <div class="key"><?php echo T_("Answer Count"); ?></div>
            <div class="value"><?php echo \dash\fit::number(a(\dash\data::conversation(), 0, 'answercount')); ?></div>
          </div>
        </li>
      <?php } //endif ?>
        <?php if(a(\dash\data::conversation(), 0, 'attachmentcount')) {?>
        <li>
          <div class="f item">
            <i class="sf-attach"></i>
            <div class="key"><?php echo T_("Attachment"); ?></div>
            <div class="value"><?php echo \dash\fit::number(a(\dash\data::conversation(), 0, 'attachmentcount')); ?></div>
          </div>
        </li>
      <?php } //endif ?>
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

  <?php if(a(\dash\data::conversation(), 0, 'userinticket') && is_array(a(\dash\data::conversation(), 0, 'userinticket'))) {?>
    <nav class="items long">
      <ul>
        <?php foreach (a(\dash\data::conversation(), 0, 'userinticket') as $key => $value) {?>
        <li>
          <div class="f item">
            <img src="<?php echo \dash\fit::img(a($value, 'avatar'), 220); ?>" alt="<?php echo a($value, 'displayname') ?>">
            <div class="key"><?php echo a($value, 'displayname') ?></div>
          </div>
        </li>
      <?php } //endif ?>
      </ul>
    </nav>
  <?php } // endif ?>

  </aside>
</div>

