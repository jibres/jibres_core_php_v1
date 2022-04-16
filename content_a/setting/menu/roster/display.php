<?php

$list = [];
if(\dash\data::menuChild() && is_array(\dash\data::menuChild()))
{
  $list = \dash\data::menuChild();
}

$option =
[
  'subaddtitle'   => T_("Add Subitem"),
  'sublink'       => \dash\url::that(). '/item',
  'sublink_args'  => [],
  'editlink'      => \dash\url::that(). '/item',
  'editlink_args' => [],
];

?>

<div class="avand-md">
  <div class="box">
    <div class="body">
      <div class="row">
        <div class="c font-bold"><?php echo \dash\data::menuDetail_title() ?></div>
        <div class="c-auto os text-gray-400 text-sm"><?php echo \dash\fit::number(\dash\data::menuChilCount()). ' '. T_("Link"); ?></div>
      </div>
    </div>
  </div>
  <form method='post' data-patch>
    <input type="hidden" name="setsort" value="1">
    <?php echo \lib\app\menu\generate::admin($list, $option); ?>
  </form>
  <nav class="items">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::this(). '/menu/item'. \dash\request::full_get(); ?>">
          <div class="go plus ok"></div>
          <div class="key"><?php echo T_("Add menu item");?></div>
        </a>
      </li>
    </ul>
  </nav>
</div>