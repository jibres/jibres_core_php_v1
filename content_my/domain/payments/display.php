<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
        <a class="link f" href="<?php echo \dash\url::this(). '/setting?domain='. $value['domain']; ?>">
            <div class="key"><code><?php echo a($value, 'domain') ?></code></div>
            <div class="value"><?php echo a($value, 'period_title'); ?></div>
            <div class="value"><?php if(a($value, 'finalprice')) {?><?php echo \dash\fit::number(a($value, 'finalprice')); ?> <small><?php echo \lib\currency::unit(); ?></small><?php }//endif ?></div>
            <time class="value datetime s0"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></time>
        </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>