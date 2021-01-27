<nav class="items">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::this(). '/datalist?mobile='. $value['mobile'] ?>">

        <div class="key txtB"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
        <div class="value txtB"><?php echo \dash\fit::number($value['count']); ?></div>

        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['lastdate']) ?></div>
        <div class="go"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

