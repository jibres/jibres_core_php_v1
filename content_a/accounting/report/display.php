<?php

$accountingSettingSaved = \lib\app\setting\get::accounting_setting();
?>
  <p class="mB5-f font-14"><?php echo T_("Useful links"); ?></p>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this() ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="<?php echo T_("Petty cash larger than 5 million") ?>" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Petty cash larger than 5 million") ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>
<div class="row">
  <?php foreach(\dash\data::reportLinks() as $key => $value) {?>
    <div class="c-xs-12 c-sm-12 c-md-3">
      <p class="mB5-f font-14"><?php echo a($value, 'title'); ?></p>
      <nav class="items long">
        <ul>
          <?php foreach($value['list'] as $k => $v) {?>
            <li>
              <a class="item f" href="<?php echo a($v, 'link') ?>">
                <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="<?php echo a($v, 'title') ?>" src="<?php echo \dash\utility\icon::url('list'); ?>">
                <div class="key"><?php echo a($v, 'title') ?></div>
                <div class="go"></div>
              </a>
            </li>
          <?php } //endfor ?>
        </ul>
      </nav>
    </div>
  <?php } //endfor ?>
</div>