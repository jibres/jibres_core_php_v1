<nav class="items">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::this(). '/view?id='. $value['id'] ?>">

        <div class="key"><?php echo \dash\str::substr_space($value['message'], 200); ?></div>

        <div class="value font-bold s0"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datecreated']) ?></div>
        <div class="go"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

