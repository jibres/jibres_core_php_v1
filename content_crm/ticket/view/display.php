<?php
$data = \dash\data::dataRow();
$customer_mode = \dash\temp::get('customer_mode');

?>
<?php if(!$customer_mode) {?>
  <?php if(!a($data, 'user_id')) {?>
  <nav class="items long">
  <ul>
    <li>
      <a class="item f">
        <img src="<?php echo \dash\data::dataRow_avatar() ?>">
        <div class="key"><?php echo T_("Guest user")?></div>
      </a>
    </li>
  </ul>
</nav>
  <?php }else{ ?>
<nav class="items long">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::here(). '/member/glance?id='. a($data, 'user_id'); ?>">
        <img src="<?php echo \dash\data::dataRow_avatar() ?>">
        <div class="key"><?php echo \dash\data::dataRow_displayname();?></div>
        <div class="value"><?php echo \dash\fit::mobile(\dash\data::dataRow_mobile());?></div>
        <div class="go"></div>
      </a>
    </li>
  </ul>
</nav>
<?php } //endif ?>
<?php } //endif ?>
<nav class="items long">
  <ul>
    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Ticket ID") ?></div>
        <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
        <div class="go detail"></div>
      </a>
    </li>
  <?php if($customer_mode && !\dash\data::dataRow_title()) {/*Not display title*/}else{?>
    <li>
      <a class="f item" <?php if(!$customer_mode) {?> href="<?php echo \dash\url::this(). '/subject?id='. \dash\request::get('id') ?>"<?php }// endif ?>>
        <div class="key"><?php echo T_("Subject") ?></div>
        <div class="value txtB"><?php if(\dash\data::dataRow_title()) { echo \dash\data::dataRow_title(); }else{echo '<span class="fc-mute">'. T_("To set subject click here"). '</span>';} ?></div>
        <div class="go detail <?php if(\dash\data::dataRow_title()){ echo 'ok';} ?>"></div>
      </a>
    </li>
  <?php } //endif ?>

    <li>
      <a class="f item" <?php if(!$customer_mode) {?> href="<?php echo \dash\face::btnSetting() ?>"<?php } //endif ?>>
        <div class="key"><?php echo T_("Status") ?></div>
        <div class="value txtB"><?php echo T_(\dash\data::dataRow_status()); ?></div>
        <div class="go <?php echo \dash\data::dataRow_statuclass(); ?>"></div>
      </a>
    </li>

    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Date") ?></div>
        <div class="value txtB"><?php echo \dash\fit::date_time(\dash\data::dataRow_datecreated()); ?></div>
        <div class="go detail"></div>
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
    <?php if(\dash\data::dataRow_ip()) {?>
    <li>
      <a target="_blank" class="f item" href="<?php echo \dash\url::jibres_domain(). 'ip/'. \dash\utility\convert::to_en_number(\dash\data::dataRow_prettyip()) ?>">
        <div class="key"><?php echo T_("IP") ?></div>
        <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_prettyip()); ?></div>
        <div class="go detail"></div>
      </a>
    </li>
  <?php } //endif ?>
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

<?php
foreach (\dash\data::conversation() as $key => $value)
{
 $userText = false;
 if(\dash\data::dataRow_user_id() == a($value, 'user_id'))
 {
  $userText = true;
 }
 if(a($value, 'type') === 'answer')
 {
  $userText = false;
 }
  ?>
  <div class="box">
    <div class="pad">
      <div class="row">
        <div class="c-auto">
          <div class="txtB">
            <img class="avatar" src="<?php echo a($value, 'avatar') ?>">
            <?php if($userText && $customer_mode) { echo T_("You"); }else{ echo  a($value, 'displayname');} ?>
          </div>
        </div>
        <div class="c"></div>
        <div class="c-auto">
          <?php if(a($value, 'see') && !$customer_mode) { ?><span class="sf-eye fc-green" title="<?php echo T_("Seen by customer") ?>"></span><?php }//endif ?>
        </div>
        <div class="cauto">
          <div class="fc-mute"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        </div>
      </div>
      <?php
        echo '<div class="mTB10 ';
       if($userText)
       {
        echo 'fc-fb ';
       }
       if(a($value, 'type') === 'note')
       {
        echo 'msg minimal ';
       }
       echo '">';
       if(a($value, 'type') === 'note')
       {
        echo '<div class="txtB fc-mute">'. T_("Note"). '</div>';
       }
       echo nl2br(a($value, 'content'));
       echo '</div>';
      ?>
      <?php if(a($value, 'file')) {?> <a target="_blank" href="<?php echo a($value, 'file') ?>" class="btn link"><i class="sf-attach"></i> <?php echo T_("Show Attachment") ?></a><?php }//endif ?>
      <?php if(a($value, 'branch')) {?>
        <div class="msg minimal info2"><?php echo T_("This message answered in new ticket") ?><a class="btn link" href="<?php echo \dash\url::this(). '/view?id='. $value['branch'] ?>"><?php echo T_("See ticket") ?></a></div>
      <?php } //endif ?>
    </div>
    <?php if(!$customer_mode) {?>
    <footer class="f">
      <?php if($userText && $key > 0 && !a($value, 'branch') && a($value, 'type') != 'note') {?>
        <div class="cauto mLR10">
          <div class="link sm fc-fb" data-title="<?php echo T_("Add this message in new ticket and answer to it?") ?>" data-confirm data-data='{"newbranch":"1", "branch": "<?php echo a($value, 'id') ?>"}'><?php echo T_("Answer in new ticket"); ?>
          </div>
        </div>
      <?php }//endif ?>
      <div class="c"></div>
      <div class="cauto"><a href="<?php echo \dash\url::this(). '/edit?id='. a($value, 'id') ?>" class="link sm"><?php echo T_("Edit") ?></a></div>
    </footer>
  <?php } //endif ?>
  </div>

<?php } ?>
<form method="post" autocomplete="off" >
  <?php if($customer_mode){ \dash\csrf::html(false); } ?>
  <div class="box">
    <div class="pad">
      <textarea class="txt" <?php if(!$customer_mode){echo 'name="answer" data-editor';}else{echo 'name="content"';} ?> rows="4" <?php \dash\layout\autofocus::html() ?> placeholder='<?php if(!$customer_mode) { echo T_("Answer to ticket"); }else{ echo T_("Write your message");} ?>'></textarea>
      <div class="mT10" data-uploader data-name='file'>
        <input type="file"  id="file1">
        <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      </div>
        <?php if(!$customer_mode) {?>
        <div class="check1">
          <input type="checkbox" name="sendmessage" id="sendmessage" checked>
          <label for="sendmessage"><?php echo T_("Send notify about your answer to creator of ticket"); ?></label>
        </div>

       <div class="check1">
          <input type="checkbox" name="note" id="inote">
          <label for="inote"><?php echo T_("Add yout message as note."); ?> <small><?php echo T_('Users do not see the notes and only the system administrator sees them') ?></small></label>
        </div>
      <?php } //endif ?>
    </div>
    <footer class="txtRa">
      <?php if($customer_mode) {?>
        <button class="btn master"><?php echo T_("Send ticket"); ?></button>
      <?php }else{ ?>
        <button class="btn master"><?php echo T_("Send answer"); ?></button>
      <?php } //endif ?>
    </footer>
  </div>
</form>