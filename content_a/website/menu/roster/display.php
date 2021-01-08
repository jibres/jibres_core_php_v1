<?php

$list = [];
if(\dash\data::menuDetail_list() && is_array(\dash\data::menuDetail_list()))
{
  $list = \dash\data::menuDetail_list();
}

?>

<div class="avand-md">
  <div class="box">
    <div class="body">
      <div class="row">
        <div class="c-xs-12 c-sm txtB"><?php echo \dash\data::menuDetail_title() ?></div>
        <div class="c-xs-12 c-sm-auto fc-mute font-12"><?php echo \dash\fit::number(count($list)). ' '. T_("Link"); ?></div>
      </div>
    </div>
  </div>
  <nav class="items">
    <ul>
      <?php foreach ($list as $key => $value) {?>
        <li>
          <a class="f item" href="<?php echo \dash\url::that(). '/item'. \dash\request::full_get(['key' => $key]) ?>">
            <div class="key"><?php echo a($value, 'title');?>
              <?php if(a($value, 'target')) {?><i class="sf-external-link fc-mute"></i> <?php }// endif ?>
            </div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //enfor ?>
    </ul>
  </nav>
  <nav class="items">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::this(). '/menu/item'. \dash\request::full_get(); ?>">
          <div class="go plus ok"></div>
          <div class="key"><?php echo T_("Add new item");?></div>
        </a>
      </li>
    </ul>
  </nav>
</div>