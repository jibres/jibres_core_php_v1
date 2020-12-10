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

<section class="sTimeline">
  <?php if(!\dash\request::get('page') || \dash\request::get('page') == 1) {?>
  <div class="event">
    <div class="box">
      <form method="post" autocomplete="off" >
        <input type="hidden" name="redirecturl" value="<?php echo \dash\url::pwd(); ?>">
        <textarea class="txt " name="answer" rows="3" <?php \dash\layout\autofocus::html() ?> placeholder='<?php echo T_("Answer to ticket") ?>'></textarea>
        <div class="txtRa">
          <button class="btn secondary  mT5"><?php echo T_("Send"); ?></button>
        </div>
      </form>
    </div>
  </div>
<?php } //endif ?>
  <?php foreach (\dash\data::conversation() as $key => $value) {?>
    <div class="event" data-done>
      <div class="box">
        <div class="detail f">
          <div class="cauto"><i class="sf-certificate"></i><?php echo a($value, 'displayname'); ?></div>
          <div class="cauto os">
            <i class="sf-calendar-o pRa5"></i><?php echo \dash\fit::date_time($value['datecreated']); ?>
          </div>
        </div>
        <p><?php echo a($value, 'content'); ?></p>
      </div>
    </div>
  <?php } ?>
</section>
<?php \dash\utility\pagination::html(); ?>