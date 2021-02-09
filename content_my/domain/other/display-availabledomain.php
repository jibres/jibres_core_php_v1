<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
       <a class="item f" href="<?php echo \dash\url::this(). '/buy/'. a($value, 'name'); ?>">
        <div class="key"><code><?php echo a($value, 'name'); ?></code></div>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>