<nav class="items long">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::this(). '/view?id='. a($value, 'id'); ?>">
        <div class="key"><?php echo strip_tags(a($value, 'txt'));  ?></div>
        <div class="value s0"><?php echo \dash\fit::mobile(a($value, 'displayname')); ?></div>
        <div class="value font-bold s0"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
        <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
        <div class="go"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

