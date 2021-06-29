<?php
$header = [];
$body   = [];
$footer = [];

$header_link = \dash\url::here(). '/section'. \dash\request::full_get(['list' => 'header']);

$list = \dash\data::currentSectionList();

if(!is_array($list))
{
  $list = [];
}

foreach ($list as $key => $value)
{
  if(a($value, 'mode')  === 'header')
  {
    $header = $value;
    $header_link = \dash\url::here(). '/section/'. a($header, 'preview', 'key'). \dash\request::full_get(['sid' => a($header, 'id')]);
  }
  elseif(a($value, 'mode')  === 'body')
  {
    $body[] = $value;
  }
  elseif(a($value, 'mode')  === 'footer')
  {
    $footer = $value;
  }
}

?>
<nav class="header items">
  <ul>
    <li>
      <a class="item f" href="<?php echo $header_link ?>">
        <img class="bg-gray-100 hover:bg-gray-200 p-4" src="<?php echo \dash\utility\icon::url('Header'); ?>">
        <div class="key"><?php echo T_("Header") ?></div>
      </a>
    </li>
  </ul>
</nav>

<form method="post" autocomplete="off">
  <input type="hidden" name="set_sort_section" value="1">
  <nav class="sections items">
    <ul data-sortable>
      <?php foreach ($body as $key => $value) { ?>
        <li>
          <a class="item f" href="<?php echo \dash\url::here(). '/section/'. a($value, 'preview', 'key'). \dash\request::full_get(['sid' => a($value, 'id')]); ?>">
            <input type="hidden" name="sort_section[]" value="<?php echo a($value, 'id') ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-4" src="<?php echo a($value, 'preview', 'icon') ?>">
            <div class="key"><?php echo a($value, 'preview', 'heading') ?></div>
            <?php if (count($body) > 1) { ?>
              <img class="p-5 opacity-70 hover:bg-gray-200" data-handle src="<?php echo \dash\utility\icon::url('DragHandle', 'minor'); ?>">
            <?php } ?>
          </a>
        </li>
      <?php } //endfor ?>
    </ul>
  </nav>
</form>

<nav class="sections items">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::here(). '/section'. \dash\request::full_get(); ?>">
        <img class="bg-gray-100 hover:bg-gray-200 p-4" src="<?php echo \dash\utility\icon::url('add'); ?>">
        <div class="key text-blue-500"><?php echo T_("Add Section") ?></div>
      </a>
    </li>
  </ul>
</nav>

<nav class="footer items">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::here(). '/footer'. \dash\request::full_get() ?>">
        <img class="bg-gray-100 hover:bg-gray-200 p-4" src="<?php echo \dash\utility\icon::url('Footer'); ?>">
        <div class="key"><?php echo T_("Footer") ?></div>
      </a>
    </li>
  </ul>
</nav>
