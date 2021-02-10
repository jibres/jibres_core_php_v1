<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
        <a class="link f" <?php if(a($value, 'verify')){ ?> href="<?php echo \dash\url::this(). '/setting?domain='. $value['domain']; ?>" <?php }//endif ?>>
            <div class="key"><?php echo a($value, 'icon'); ?> <?php echo a($value, 'title'); ?></div>

            <div class="value">
                 <?php if(a($value, 'domain') && a($value, 'domain_id')) {?>
                    <code><?php echo a($value, 'domain') ?></code>
                <?php } // endif ?>
            </div>
            <time class="value datetime s0"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></time>
        </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>