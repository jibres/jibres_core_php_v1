<nav class="items long">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::that(). '/view?id='. $value['id'] ?>">
        <div class="key"><?php echo T_("Ticket"). ' #'. $value['id'];  ?></div>
        <div class="value s0"><?php echo \dash\fit::mobile(a($value, 'displayname')); ?></div>
        <div class="value txtB s0"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
        <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
        <div class="go"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

