<?php
$header = [];
$body   = [];
$footer = [];

$deleted_section = [];

$header_link = \dash\url::here(). '/section'. \dash\request::full_get(['folder' => 'header']);
$footer_link = \dash\url::here(). '/section'. \dash\request::full_get(['folder' => 'footer']);

$list = \dash\data::currentSectionList();

if(!is_array($list))
{
  $list = [];
}

foreach ($list as $key => $value)
{
  if(a($value, 'folder')  === 'header')
  {
    $header = $value;
    $header_link = \dash\url::here(). '/section/'. a($header, 'section'). \dash\request::full_get(['sid' => a($header, 'id')]);
  }
  elseif(a($value, 'folder')  === 'body')
  {
    $body[] = $value;
  }
  elseif(a($value, 'folder')  === 'footer')
  {
    $footer = $value;
    $footer_link = \dash\url::here(). '/section/'. a($footer, 'section'). \dash\request::full_get(['sid' => a($footer, 'id')]);
  }
}
?>

  <nav class="header items long" data-postMsg>
    <ul>
      <li>
        <a class="item f" href="<?php echo $header_link ?>" id="<?php echo a($header, 'section:list:id'); ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-1" src="<?php echo \dash\utility\icon::url('Header'); ?>">
          <div class="key"><?php echo T_("Header") ?></div>
        </a>
      </li>
    </ul>
  </nav>

  <form method="post" autocomplete="off">
    <input type="hidden" name="set_sort_section" value="1">
    <nav class="sections items long" data-postMsg>
      <ul data-sortable>
        <?php foreach ($body as $key => $value)
        {

          if(a($value, 'status_preview') === 'deleted')
          {
            $deleted_section[] = $value;
            continue;
          }
          $myTitle = implode(' | ', [a($value, 'section'), a($value, 'preview', 'type')]);
        ?>
          <li>
            <a title="<?php echo $myTitle ?>" id="<?php echo a($value, 'section:list:id'); ?>" class="item f <?php if(a($value, 'status_preview') === 'hidden'){ echo 'opacity-30';} ?>" href="<?php echo \dash\url::here(). '/section/'. a($value, 'section'). \dash\request::full_get(['sid' => a($value, 'id')]); ?>">
              <input type="hidden" name="sort_section[]" value="<?php echo a($value, 'id') ?>">
              <img class="bg-gray-100 hover:bg-gray-200 p-1" src="<?php echo a($value, 'preview', 'icon') ?>">
              <div class="key" title="<?php if(a($value, 'preview', 'heading') !== null) { echo a($value, 'preview', 'heading'); }else{ echo  T_("Without title");} ?>"><?php echo a($value, 'section:preview:title'); ?></div>
<?php if(0) {?>
              <div class="value">123</div>
<?php }?>
<?php
switch (a($value, 'preview', 'os'))
{
  case 'windows':
    echo \dash\utility\icon::bootstrap('windows', 'text-yellow-500');
    break;

  case 'linux':
    echo \dash\utility\icon::bootstrap('terminal', 'text-yellow-500');
    break;

  case 'mac':
    echo \dash\utility\icon::bootstrap('apple', 'text-yellow-500');
    break;

  default:
    break;
}

switch (a($value, 'preview', 'device'))
{
  case 'mobile':
    echo \dash\utility\icon::bootstrap('phone', 'text-green-500');
    break;

  case 'desktop':
    echo \dash\utility\icon::bootstrap('pc-display-horizontal', 'text-green-500');
    break;

  default:
    break;
}
?>
              <?php if (count($body) > 1) { ?>
                <img class="p-2 opacity-70 hover:bg-gray-300 sortHandle" data-handle src="<?php echo \dash\utility\icon::url('DragHandle', 'minor'); ?>">
              <?php } ?>
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>
  </form>

  <nav class="sections items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::here(). '/section'. \dash\request::full_get(['folder' => 'body']); ?>">
          <?php echo \dash\utility\icon::svg('add', null, 'null', 'text-green-800 bg-gray-100 hover:bg-gray-200 p-1'); ?>
          <div class="key text-green-800 font-bold"><?php echo T_("Add Section") ?></div>
        </a>
      </li>
    </ul>
  </nav>

  <nav class="header items long" data-postMsg>
    <ul>
      <li>
        <a class="item f" href="<?php echo $footer_link ?>" id="<?php echo a($footer, 'section:list:id'); ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-1" src="<?php echo \dash\utility\icon::url('Footer'); ?>">
          <div class="key"><?php echo T_("Footer") ?></div>
        </a>
      </li>
    </ul>
  </nav>


  <?php if($deleted_section) {?>
    <label class="mt-6"><?php echo T_("Deleted section") ?> <small><?php echo T_("After saving the page, this section will be deleted completely") ?></small></label>

    <nav class="sections items long">
      <ul data-sortable>
        <?php foreach ($deleted_section as $key => $value) {?>
          <li>
            <a class="item f opacity-40" href="<?php echo \dash\url::here(). '/section/'. a($value, 'section'). \dash\request::full_get(['sid' => a($value, 'id')]); ?>">
              <img class="bg-gray-100 hover:bg-gray-200 p-1" src="<?php echo a($value, 'preview', 'icon') ?>" alt='Footer'>
              <div class="key"><?php if(a($value, 'preview', 'heading') !== null) { echo a($value, 'preview', 'heading'); }else{ echo '<i class="text-gray-400">'. T_("Without title"). '</i>';} ?></div>
              <img class="p-2 opacity-70 hover:bg-gray-300" src="<?php echo \dash\utility\icon::url('Delete', 'minor'); ?>">
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>

    <?php } //endif ?>



