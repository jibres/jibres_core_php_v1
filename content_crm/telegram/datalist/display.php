<nav class="items">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
  <li>
      <a class="f align-center" href="<?php echo \dash\url::this(). '/view?id='. $value['id'] ?>">
        <div class="key"><?php if(a($value, 'sendtext')) { echo substr(strip_tags(a($value, 'sendtext')), 0, 100); }else{  ?><i class="text-gray-400">--- </i> <?php } //endif ?></div>
        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['senddate']) ?></div>
        <div class="go"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

