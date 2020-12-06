<nav class="items long">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" >
        <div class="key"><?php echo strip_tags(\dash\get::index($value, 'txt'));  ?></div>
        <div class="value s0"><?php echo \dash\fit::mobile(\dash\get::index($value, 'displayname')); ?></div>
        <div class="value txtB s0"><?php echo \dash\fit::mobile(\dash\get::index($value, 'mobile')); ?></div>
        <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
        <div class="go"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

