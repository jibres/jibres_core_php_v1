<div class="row">
  <?php foreach(\dash\data::dataTable() as $key => $value) {
  	$link = \dash\url::current(). \dash\request::full_get(['detail' => 1, 'quarter' => $key]);
  	?>
  <div class="c-xs-12 c-sm-12 c-md-3">
    <p class="mB5-f font-14"><?php echo a($value, 'title'); ?></p>
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo $link ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="report" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Total") ?></div>
            <div class="value" data-copy='<?php echo a($value, 'total') ?>'><?php echo \dash\fit::number(a($value, 'total')) ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo $link ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="report" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Total discount") ?></div>
            <div class="value" data-copy='<?php echo a($value, 'totaldiscount') ?>'><?php echo \dash\fit::number(a($value, 'totaldiscount')) ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo $link ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="report" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Total vat 6%") ?></div>
            <div class="value" data-copy='<?php echo a($value, 'totalvat6') ?>'><?php echo \dash\fit::number(a($value, 'totalvat6')) ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo $link ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="report" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Total vat 3%") ?></div>
            <div class="value" data-copy='<?php echo a($value, 'totalvat3') ?>'><?php echo \dash\fit::number(a($value, 'totalvat3')) ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>
  </div>
<?php } //endfor ?>
</div>