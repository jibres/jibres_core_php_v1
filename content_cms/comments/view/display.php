<?php
$dataRow = \dash\data::dataRow();

?>


<nav class="items long">
  <ul>
<?php if(a($dataRow, 'user_id')) {?>
    <li>
      <a class="item f" href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. a($dataRow, 'user_id'); ?>">
        <img src="<?php echo a($dataRow, 'avatar') ?>">
        <div class="key"><?php echo a($dataRow, 'user_displayname');?></div>
        <div class="value"><?php echo \dash\fit::mobile(a($dataRow, 'user_mobile'));?></div>
        <div class="go"></div>
      </a>
    </li>
<?php }elseif(a($dataRow, 'displayname')) {?>
    <li>
      <a class="item f">
        <div class="key"><?php echo T_("Name") ?></div>
        <div class="value"><?php echo \dash\fit::mobile(a($dataRow, 'displayname'));?></div>
        <div class="go detail"></div>
      </a>
    </li>
<?php } // endif ?>
<?php if(a($dataRow, 'mobile')) {?>
    <li>
      <a class="item f">
        <div class="key"><?php echo T_("Mobile") ?></div>
        <div class="value"><?php echo \dash\fit::mobile(a($dataRow, 'mobile'));?></div>
        <div class="go"></div>
      </a>
    </li>
<?php } // endif ?>
    </ul>
</nav>
<?php if(a($dataRow, 'product_id')) {?>
<nav class="items long">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/products/edit?id='. a($dataRow, 'product_id'); ?>">
        <img src="<?php echo a($dataRow, 'product_thumb') ?>">
        <div class="key"><?php echo a($dataRow, 'product_title');?></div>
        <div class="go"></div>
      </a>
    </li>
  </ul>
</nav>
<?php } // endif ?>

<?php if(a($dataRow, 'post_id')) {?>
<nav class="items long">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::here(). '/posts/edit?id='. a($dataRow, 'post_id'); ?>">
        <img src="<?php echo a($dataRow, 'post_thumb') ?>">
        <div class="key"><?php echo a($dataRow, 'post_title');?></div>
        <div class="go"></div>
      </a>
    </li>
  </ul>
</nav>
<?php } // endif ?>
<nav class="items long">
  <ul>
    <li>
      <a class="item f">
        <div class="key"><?php echo T_("Date created");?></div>
        <div class="value txtB ltr"><?php echo \dash\fit::date_time(a($dataRow, 'datecreated'));?></div>

      </a>
    </li>
    <?php if(a($dataRow, 'datemodified')) {?>
     <li>
      <a class="item f">
        <div class="key"><?php echo T_("Datemodified");?></div>
        <div class="value txtB ltr"><?php echo \dash\fit::date_time(a($dataRow, 'datemodified'));?></div>
      </a>
    </li>
  <?php } //endif ?>

    <li>
      <a class="item f">
        <div class="key"><?php echo T_("Status");?></div>
        <div class="value txtB ltr"><?php echo a($dataRow, 'tstatus'); ?></div>
        <div class="go <?php echo a($dataRow, 'html_class') ?>"></div>
      </a>
    </li>

      <li>
      <a class="item f" href="<?php echo 'https://jibres.'. \dash\url::jibres_tld(). '/ip/'. long2ip(a($dataRow, 'ip')) ?>" target="_blank">
        <div class="key"><?php echo T_("IP");?></div>
        <div class="value txtB ltr"><?php echo \dash\fit::text(long2ip(a($dataRow, 'ip'))); ?></div>
        <div class="go"></div>
      </a>
    </li>

    <?php if(a($dataRow, 'parent')) {?>
     <li>
      <a class="item f" href="<?php echo \dash\data::viewCommentModule(). \dash\request::full_get(['cid' => a($dataRow, 'parent')]); ?>">
        <div class="key"><?php echo T_("In response to the comment");?></div>
        <div class="value ltr"><?php echo \dash\fit::text(a($dataRow, 'parent'));?></div>
        <div class="go"></div>
      </a>
    </li>
  <?php } //endif ?>



    <?php if(a($dataRow, 'star')) {?>
    <li>
      <a class="item f">
        <div class="key"><?php echo T_("Star");?></div>
        <?php for ($i=1; $i <= a($dataRow, 'star') ; $i++) { ?>
          <div class="go star gold"></div>
        <?php } //endfor ?>
      </a>
    </li>
  <?php } //endif ?>


    <?php if(\dash\data::answerCount()) {?>
    <li>
      <a class="item f" href="<?php echo \dash\data::listCommentMoudle(). \dash\request::full_get(['cid' => null, 'answerto' => \dash\request::get('cid')]); ?>">
        <div class="key"><?php echo T_("Show Answer to this comment");?></div>
        <div class="value txtB ltr"><?php echo \dash\fit::number(\dash\data::answerCount()); ?></div>
        <div class="go"></div>
      </a>
    </li>
  <?php } //endif ?>

  </ul>
</nav>


<div class="box">
  <div class="pad">
    <?php if(a($dataRow, 'title')) {?>
    <div class="txtB"><?php echo a($dataRow, 'title'); ?></div>
    <?php } //endif ?>
    <p><?php echo nl2br(a($dataRow, 'content')) ?></p>
  </div>
  <footer>
    <div class="row">
      <div class="c-auto">
        <?php if(!a($dataRow, 'parent')) {?>
        <div class="link sm" data-kerkere-icon data-kerkere='.answerToComment'><?php echo T_("Answer to comment") ?></div>
      <?php } //endif ?>
      </div>
      <div class="c"></div>
      <div class="c-auto"><a class="link sm" href="<?php echo \dash\data::editCommentModule(). \dash\request::full_get(['cid' => a($dataRow, 'id')]) ?>"><?php echo T_("Edit comment") ?></a></div>
    </div>
  </footer>
</div>

<div class="answerToComment" data-kerkere-content='hide'>
  <form method='post' autocomplete="off">
    <input type="hidden" name="answertocomment" value="answertocomment">
    <div class="box">
      <div class="pad">
        <label for="answertitle"><?php echo T_("Title") ?></label>
        <div class="input">
          <input type="text" name="answertitle" id="answertitle" maxlength="100">
        </div>
        <label for="answer"><?php echo T_("Answer to comment") ?></label>
        <textarea class="txt" id="answer" name="answer" rows="3"></textarea>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save answer") ?></button>
      </footer>
    </div>
  </form>
</div>

<div class="box">
  <div class="pad">
    <div class="row">
      <div class="c-auto c-xs-6 mTB10"><div data-ajaxify data-data='{"status": "approved"}' class="btn success outline"><?php echo T_("Approved"); ?></div></div>
      <div class="c-auto c-xs-6 mTB10"><div data-ajaxify data-data='{"status": "unapproved"}' class="btn secondary outline"><?php echo T_("Unapproved"); ?></div></div>
      <div class="c-auto c-xs-6 mTB10"><div data-ajaxify data-data='{"status": "spam"}' class="btn pain outline"><?php echo T_("Spam"); ?></div></div>
      <div class="c-auto c-xs-6 mTB10"><div data-confirm data-data='{"remove": "remove"}' class="btn danger outline"><?php echo T_("Remove"); ?></div></div>
    </div>
  </div>
</div>

