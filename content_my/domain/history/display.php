<nav class="items pwaMultiLine">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
        <a class="link f" <?php if(a($value, 'verify')){ ?> href="<?php echo \dash\url::this(). '/setting?domain='. $value['domain']; ?>" <?php }//endif ?>>
            <div class="key">
              <div class="line1"><?php echo a($value, 'icon'); ?> <?php echo a($value, 'title'); ?></div>
              <div class="line2 f">
                <time class="cauto datetime"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></time>
                <div class="c"></div>
                <div class="cauto">
                   <?php if(a($value, 'domain') && a($value, 'domain_id')) {?>
                      <?php echo a($value, 'domain') ?>
                  <?php } // endif ?>
                </div>
              </div>

              </div>
        </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>