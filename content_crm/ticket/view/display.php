<?php $data = \dash\data::dataRow(); ?>
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
<nav class="items long">
  <ul>
    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Ticket ID") ?></div>
        <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
        <div class="go detail ok"></div>
      </a>
    </li>

    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/subject?id='. \dash\request::get('id') ?>">
        <div class="key"><?php echo T_("Subject") ?></div>
        <div class="value txtB"><?php if(\dash\data::dataRow_title()) { echo \dash\data::dataRow_title(); }else{echo '<span class="fc-mute">'. T_("Set Subject"). '</span>';} ?></div>
        <div class="go detail"></div>
      </a>
    </li>

    <li>
      <a class="f item" href="<?php echo \dash\face::btnSetting() ?>">
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

    <li>
      <a class="f item" href="<?php echo \dash\face::btnSetting(); ?>">
        <div class="key"><?php echo T_("Solved status") ?></div>
        <div class="value txtB"><?php if(\dash\data::dataRow_solved()){echo T_("The problem is solved");}else{echo T_("The problem is not solved");} ?></div>
        <div class="go <?php if(\dash\data::dataRow_solved()){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
    </li>

    <li>
      <a target="_blank" class="f item" href="<?php echo \dash\url::jibres_domain(). 'ip/'. \dash\utility\convert::to_en_number(\dash\data::dataRow_prettyip()) ?>">
        <div class="key"><?php echo T_("IP") ?></div>
        <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_prettyip()); ?></div>
        <div class="go detail"></div>
      </a>
    </li>
    <?php if(\dash\data::dataRow_base()) {?>
    <li class="">
      <a class="f item" href='<?php echo \dash\url::this(). '/view?id='. \dash\data::dataRow_base(); ?>'>
        <div class="key"><?php echo T_("This ticket is branch of another ticket"); ?></div>
        <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_base()); ?></div>
        <div class="go detail"></div>
      </a>
    </li>
  <?php }// endif ?>
  </ul>
</nav>

<?php foreach (\dash\data::conversation() as $key => $value) {?>
  <div class="box">
    <div class="pad">
      <div class="row">
        <div class="c-auto">
          <div class="txtB">
            <img class="avatar" src="<?php echo a($value, 'avatar') ?>">
            <?php echo a($value, 'displayname'); ?>
          </div>
        </div>
        <div class="c"></div>
        <div class="c-auto">
          <?php if(a($value, 'see')) { ?><span class="sf-eye fc-green" title="<?php echo T_("Seen by customer") ?>"></span><?php }//endif ?>
        </div>
        <div class="cauto">
          <div class="fc-mute"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        </div>
      </div>
      <?php $userText = false; if(\dash\data::dataRow_user_id() == a($value, 'user_id')) { $userText = true; } ?>
      <div class="mTB10 <?php if($userText) { echo 'fc-fb';} ?>"><?php echo a($value, 'content'); ?></div>
      <?php if(a($value, 'file')) {?> <a target="_blank" href="<?php echo a($value, 'file') ?>" class="btn link"><i class="sf-attach"></i> <?php echo T_("Show Attachment") ?></a><?php }//endif ?>
      <?php if(a($value, 'branch')) {?>
        <div class="msg info2"><?php echo T_("This message answered in new ticket") ?><a class="btn link" href="<?php echo \dash\url::this(). '/view?id='. $value['branch'] ?>"><?php echo T_("See ticket") ?></a></div>
      <?php } //endif ?>
    </div>
    <footer class="f">
      <?php if($userText && $key > 0 && !a($value, 'branch')) {?>
        <div class="cauto mLR10">
          <div class="link sm fc-fb" data-title="<?php echo T_("Add this message in new ticket and answer to it?") ?>" data-confirm data-data='{"newbranch":"1", "branch": "<?php echo a($value, 'id') ?>"}'><?php echo T_("Answer in new ticket"); ?>
          </div>
        </div>
      <?php }//endif ?>
      <div class="c"></div>
      <div class="cauto"><a href="<?php echo \dash\url::this(). '/edit?id='. a($value, 'id') ?>" class="link sm"><?php echo T_("Edit") ?></a></div>
    </footer>
  </div>

<?php } ?>
<form method="post" autocomplete="off" >
  <div class="box">
    <div class="pad">
      <input type="hidden" name="redirecturl" value="<?php echo \dash\url::pwd(); ?>">
      <textarea class="txt" name="answer" data-editor rows="3" <?php \dash\layout\autofocus::html() ?> placeholder='<?php echo T_("Answer to ticket") ?>'></textarea>
      <div class="mT10" data-uploader data-name='file'>
        <input type="file"  id="file1">
        <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      </div>
    </div>
    <footer class="f">
      <div class="cauto">
        <div class="check1">
          <input type="checkbox" name="sendmessage" id="sendmessage" checked>
          <label for="sendmessage"><?php echo T_("Send notify about your answer to creator of ticket"); ?>
        </div>
      </div>
      <div class="c"></div>
      <div class="cauto">
        <button class="btn master"><?php echo T_("Send answer"); ?></button>
      </div>
    </footer>
  </div>
</form>