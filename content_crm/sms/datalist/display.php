<nav class="items">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::that(). '/view?id='. $value['id'] ?>">

        <div class="key"><?php echo T_($value['message']); ?></div>

        <div class="value txtB s0"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datesend']) ?></div>
        <div class="go"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

