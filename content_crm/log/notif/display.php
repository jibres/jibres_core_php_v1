<nav class="items pwaMultiLine">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <li>
        <a class="f align-center">
          <div class="key">
            <div class="line1"><?php echo a($value, 'type'); ?></div>
            <div class="line2 f txtB">
              <div class="c">
                <?php echo a($value, 'message'); ?>

              </div>
              <div class="cauto">
                <?php echo a($value, 'urlkingdom'). '/'. a($value, 'urldir'); ?>
              </div>
            </div>
          </div>

          <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
          <div class="go detail s0"></div>
        </a>
      </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

