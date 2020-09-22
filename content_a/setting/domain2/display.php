

<?php if(!\dash\data::dataTable()){?>

  <div class="msg warn2 txtC txtB fs14"><?php echo T_("No result found") ?></div>

<?php }else{ ?>


<div class="avand-md">
  <nav class="items">
    <ul>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <li>
          <a class="f item" target="_blank" href="<?php echo \dash\url::protocol(). '://'. \dash\get::index($value, 'domain'); ?>">
            <div class="key"><?php echo \dash\get::index($value, 'domain'); ?></div>
            <div class="value"><?php echo \dash\get::index($value, 'tstatus'); ?></div>
            <div class="go"></div>
          </a>
      </li>
      <?php } //endfor ?>

    </ul>
  </nav>
</div>


<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>