<nav class="items long">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/datalist?chatid='. $value['chatid'] ?>">
        <img src="<?php echo a($value, 'user_detail', 'avatar'); ?>" alt="<?php echo a($value, 'chatid'); ?>">
        <div class="key"><?php echo a($value, 'user_detail', 'displayname'); ?></div>
        <div class="value txtB"><?php echo \dash\fit::number($value['count']); ?></div>
        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['lastdate']) ?></div>
        <div class="go"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>