<?php
$dataRow = \dash\data::dataRow();

?>
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

  </ul>
</nav>

<?php if(a($dataRow, 'user_id')) {?>
<nav class="items long">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. a($dataRow, 'user_id'); ?>">
        <img src="<?php echo a($dataRow, 'avatar') ?>">
        <div class="key"><?php echo a($dataRow, 'displayname');?></div>
        <div class="value"><?php echo \dash\fit::mobile(a($dataRow, 'mobile'));?></div>
        <div class="go"></div>
      </a>
    </li>
    </ul>
</nav>
<?php } // endif ?>
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
      <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/products/edit?id='. a($dataRow, 'post_id'); ?>">
        <img src="<?php echo a($dataRow, 'product_thumb') ?>">
        <div class="key"><?php echo a($dataRow, 'product_title');?></div>
        <div class="go"></div>
      </a>
    </li>
  </ul>
</nav>
<?php } // endif ?>

<div class="box">
  <div class="pad">
    <?php if(a($dataRow, 'title')) {?>
    <div class="txtB"><?php echo a($dataRow, 'title'); ?></div>
    <?php } //endif ?>
    <p>

      <?php echo nl2br(a($dataRow, 'content')) ?>
    </p>
  </div>
  <footer>
    <div class="row">
      <div class="c-auto"><a class="link sm" href="<?php echo \dash\url::this(). '/edit?id='. a($dataRow, 'id') ?>"><?php echo T_("Answer to comment") ?></a></div>
      <div class="c"></div>
      <div class="c-auto"><a class="link sm" href="<?php echo \dash\url::this(). '/edit?id='. a($dataRow, 'id') ?>"><?php echo T_("Edit comment") ?></a></div>
    </div>
  </footer>
</div>

<div class="box">
  <div class="pad">

    <div class="row">
      <div class="c-auto c-xs-6 mTB10"><div data-ajaxify data-data='{"status": "approved"}' class="btn success outline"><?php echo T_("Approved"); ?></div></div>
      <div class="c-auto c-xs-6 mTB10"><div data-ajaxify data-data='{"status": "unapproved"}' class="btn secondary outline"><?php echo T_("Unapproved"); ?></div></div>
      <div class="c-auto c-xs-6 mTB10"><div data-ajaxify data-data='{"status": "spam"}' class="btn pain outline"><?php echo T_("Spam"); ?></div></div>
      <div class="c-auto c-xs-6 mTB10"><div data-confirm data-data='{"remove": "remove"}' class="btn danger outline"><?php echo T_("Remove"); ?></div></div>
      <div class="c"></div>

    </div>
  </div>
</div>

