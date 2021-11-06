<?php
if(\dash\request::get('gethtml') == '1')
{
    require_once "display-chat.php";
    return;
}

$data = \dash\data::dataRow();

$customer_mode = \dash\temp::get('customer_mode');
$ticket_in_content_my = \dash\temp::get('ticket_in_content_my');


if($customer_mode && !$ticket_in_content_my)
{
  echo '<div class="row ticketPage">'  ;

    echo '<div class="c-xs-12 c-sm-12">';
      require_once "display-answer.php";
    echo '</div>';

    echo '<div class="c-xs-12 c-sm-12">';
      require_once "display-chat.php";
    echo '</div>';

  echo '</div>';
  return;
}

?>


<div class="row ticketPage">
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
    <?php require_once "display-answer.php"; ?>

    <?php require_once "display-chat.php"; ?>

  </div>
  <aside class="c-xs-12 c-sm-12 c-md-4 c-lg-3 c-xxl-2 ticketSidebar">

    <a <?php if(a($data, 'user_id') && !$customer_mode) {echo "href='".\dash\url::kingdom(). '/crm/member/glance?id='. \dash\data::dataRow_user_id()."'"; } //endif ?> class="hero">
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
            <?php echo \dash\utility\icon::bootstrap('hash'); ?>
          </div>
        </li>

      </ul>
    </nav>


    <nav class="items long">
      <ul>
      <?php if(\dash\data::dataRow_base()) {?>
        <li class="">
          <a class="f item" href='<?php echo \dash\url::this(). '/view?id='. \dash\data::dataRow_base(); ?>'>
            <?php echo \dash\utility\icon::bootstrap('asterisk', 'text-red-500'); ?>
            <div class="key"><?php echo T_("Separated from"); ?></div>
            <div class="value"><?php echo T_("Ticket"). ' '. \dash\data::dataRow_base(); ?></div>
          </a>
        </li>
      <?php }// endif ?>
        <li>
          <div class="f item">
            <?php echo \dash\utility\icon::bootstrap('Calendar date'); ?>
            <div class="key"><?php echo T_("Submit Date") ?></div>
            <time class="value" datetime="<?php echo \dash\data::dataRow_datecreated(); ?>"><?php echo \dash\fit::date_time(\dash\data::dataRow_datecreated()); ?></time>
          </div>
        </li>
        <li>
          <div class="f item">
            <?php echo \dash\utility\icon::bootstrap('watch'); ?>
            <div class="key"></div>
            <div class="value"><?php echo \dash\fit::date_human(\dash\data::dataRow_datecreated()); ?></div>
          </div>
        </li>
        <?php if(\dash\data::dataRow_answertime() && !$customer_mode) {?>
        <li>
          <div class="f item">
            <?php echo \dash\utility\icon::bootstrap('activity'); ?>
            <div class="key"><?php echo T_("First Answer") ?></div>
            <div class="value "><?php echo \dash\utility\human::time(\dash\data::dataRow_answertime(), true); ?></div>
          </div>
        </li>
      <?php } //endif ?>
        <?php if(\dash\data::dataRow_subtype() && !$customer_mode) {?>
          <li>
          <div class="f item">
            <?php echo \dash\utility\icon::bootstrap('braces'); ?>
            <div class="key"><?php echo T_("Type") ?></div>
            <div class="value "><?php echo T_(ucfirst(\dash\data::dataRow_subtype())); ?></div>
          </div>
        </li>
      <?php } //endif ?>
      </ul>
    </nav>


    <nav class="items long">
      <ul>
        <?php if(\dash\data::dataRow_mobile()) {?>
          <li>
            <a class="f item" href="tel:+<?php echo \dash\data::dataRow_mobile();?>">
              <?php echo \dash\utility\icon::bootstrap('telephone'); ?>
              <div class="key"><?php echo T_("Mobile") ?></div>
              <div class="value mobile"><?php echo \dash\fit::mobile(\dash\data::dataRow_mobile()); ?></div>
            </a>
          </li>

        <?php }elseif($customer_mode) {?>
          <li>
            <a class="f item" href="<?php echo \dash\url::kingdom(). '/enter?referer='. urlencode(\dash\url::location());  ?>">
              <?php echo \dash\utility\icon::bootstrap('box-arrow-in-left'); ?>
              <div class="key"><?php echo T_("Please login to save ticket") ?></div>
            </a>
          </li>

        <?php }else{ ?>
          <li>
            <a class="f item" href="<?php echo \dash\url::this(). '/assign?id='. \dash\data::dataRow_id();  ?>">
              <?php echo \dash\utility\icon::bootstrap('plug'); ?>
              <div class="key"><?php echo T_("Assign to user") ?></div>
            </a>
          </li>
        <?php } //endif ?>
        <?php if(\dash\data::dataRow_useremail()){ ?>
        <li>
          <div class="f item" data-copy='<?php echo \dash\data::dataRow_useremail(); ?>'>
              <?php echo \dash\utility\icon::bootstrap('at'); ?>
            <div class="key"><?php echo T_("Email") ?></div>
            <div class="value"><?php echo \dash\data::dataRow_useremail(); ?></div>
          </div>
        </li>
      <?php } //endif ?>
        <?php if(\dash\data::dataRow_usertelegram()){ ?>
        <li>
          <a class="f item" href="https://t.me/<?php echo \dash\data::dataRow_usertelegram(); ?>">
              <?php echo \dash\utility\icon::bootstrap('telegram'); ?>
            <div class="key"><?php echo T_("Telegram") ?></div>
            <div class="value txtL ltr"><?php echo \dash\data::dataRow_usertelegram(); ?></div>
          </a>
        </li>
      <?php } //endif ?>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <div class="f item">
            <?php echo \dash\data::dataRow_statuclass(); ?>
            <div class="key"><?php echo T_("Status") ?></div>
            <div class="value txtB"><?php echo T_(\dash\data::dataRow_status() === 'close' ? 'archive' : \dash\data::dataRow_status()); ?></div>
          </div>
        </li>
<?php if(!$customer_mode) {?>
<?php if(a(\dash\data::conversation(), 0, 'answercount') === 0 && \dash\data::dataRow_status() === 'awaiting') {?>
            <li>
              <div class="f item"
              data-confirm
              data-data='{"setstatus": "set", "status": "spam"}'
              data-title="<?php echo T_("Report as spam"); ?>">
                <?php echo \dash\utility\icon::bootstrap('X octagon fill', 'text-yellow-600'); ?>
                <div class="key"><?php echo T_("Is spam?") ?></div>
                <div class="go"></div>
              </div>
          </li>
<?php } else { ?>
<?php if(\dash\data::dataRow_status() !== 'close' && \dash\data::dataRow_status() !== 'deleted' && \dash\data::dataRow_status() !== 'spam') {?>
            <li>
              <div class="f item" data-confirm data-data='{"setstatus": "set", "status": "close"}' data-title="<?php echo T_("Do you want to archive this ticket?"); ?>">
                <?php echo \dash\utility\icon::bootstrap('archive-fill', 'text-gray-500'); ?>
                <div class="key"><?php echo T_("Set ticket as archive") ?></div>
              </div>
          </li>
<?php } //endif ?>
<?php if(\dash\data::dataRow_status() === 'close') {?>
            <li>
              <div class="f item"data-confirm data-data='{"setstatus": "set", "status": "deleted"}' data-title="<?php echo T_("Do you want to delete this ticket?"); ?>">
                <?php echo \dash\utility\icon::bootstrap('trash', 'text-red-500'); ?>
                <div class="key"><?php echo T_("Remove ticket") ?></div>
              </div>
          </li>
<?php } //endif ?>
<?php } //endif ?>
        <li>
          <div class="f item" data-ajaxify data-data='{"setsolved": "set", "solved": "<?php echo intval(\dash\data::dataRow_solved()); ?>"}' data-title="<?php if(\dash\data::dataRow_solved()) {echo T_("Is the problem unresolved and still is?");}else{echo T_("Has the problem raised in this ticket been resolved?");} ?>">
            <?php if(\dash\data::dataRow_solved()) { ?>
            <?php echo \dash\utility\icon::bootstrap('patch-check-fill', 'text-green-500'); ?>
            <?php } else { ?>
            <?php echo \dash\utility\icon::bootstrap('patch-exclamation', 'text-gray-500'); ?>
            <?php } ?>
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
            <?php echo \dash\utility\icon::bootstrap('chat-quote', 'text-gray-500'); ?>
            <div class="key"><?php echo T_("Message Count"); ?></div>
            <div class="value"><?php echo \dash\fit::number(a(\dash\data::conversation(), 0, 'messagecount')); ?></div>
          </div>
        </li>
      <?php } //endif ?>
        <?php if(a(\dash\data::conversation(), 0, 'answercount')) {?>
        <li>
          <div class="f item">
            <?php echo \dash\utility\icon::bootstrap('chat-right-quote-fill', 'text-gray-500'); ?>
            <div class="key"><?php echo T_("Answer Count"); ?></div>
            <div class="value"><?php echo \dash\fit::number(a(\dash\data::conversation(), 0, 'answercount')); ?></div>
          </div>
        </li>
      <?php } //endif ?>
        <?php if(a(\dash\data::conversation(), 0, 'attachmentcount')) {?>
        <li>
          <div class="f item">
            <?php echo \dash\utility\icon::bootstrap('paperclip', 'text-blue-500'); ?>
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

