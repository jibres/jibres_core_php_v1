
<?php if (\dash\detect\device::detectPWA()) { ?>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
       <a class="item f" href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'name'); ?>">
        <div class="key"><code><?php echo \dash\get::index($value, 'name'); ?></code></div>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php } else { ?>



<div class="f">
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <div class="c2 m6 s12 pA5">
        <a class="stat x70 available" href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'name'); ?>">
            <h3><?php echo T_("Available") ?></h3>
            <div class="val ltr"><?php echo \dash\get::index($value, 'name'); ?></div>
        </a>
    </div>
<?php } //endfor ?>
</div>
<?php } //endif ?>
<?php \dash\utility\pagination::html(); ?>