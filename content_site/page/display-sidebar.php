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
<nav class="header items">
  <ul>
    <li>
      <a class="item f" href="<?php echo $header_link ?>">
        <img class="bg-gray-100 hover:bg-gray-200 p-2.5" src="<?php echo \dash\utility\icon::url('Header'); ?>">
        <div class="key"><?php echo T_("Header") ?></div>
      </a>
    </li>
  </ul>
</nav>

<form method="post" autocomplete="off">
  <input type="hidden" name="set_sort_section" value="1">
  <nav class="sections items">
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
          <a title="<?php echo $myTitle ?>" class="item f <?php if(a($value, 'status_preview') === 'hidden'){ echo 'opacity-30';} ?>" href="<?php echo \dash\url::here(). '/section/'. a($value, 'section'). \dash\request::full_get(['sid' => a($value, 'id')]); ?>">
            <input type="hidden" name="sort_section[]" value="<?php echo a($value, 'id') ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2.5" src="<?php echo a($value, 'preview', 'icon') ?>">
            <div class="key"><?php if(a($value, 'preview', 'heading') !== null) { echo a($value, 'preview', 'heading'); }else{ echo '<i class="fc-mute">'. T_("Without title"). '</i>';} ?></div>
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
      <a class="item f" href="<?php echo \dash\url::here(). '/section'. \dash\request::full_get(['folder' => 'body']); ?>">
        <img class="bg-gray-100 hover:bg-gray-200 p-2.5" src="<?php echo \dash\utility\icon::url('add'); ?>">
        <div class="key text-blue-500"><?php echo T_("Add Section") ?></div>
      </a>
    </li>
  </ul>
</nav>

<nav class="header items">
  <ul>
    <li>
      <a class="item f" href="<?php echo $footer_link ?>">
        <img class="bg-gray-100 hover:bg-gray-200 p-2.5" src="<?php echo \dash\utility\icon::url('Footer'); ?>">
        <div class="key"><?php echo T_("Footer") ?></div>
      </a>
    </li>
  </ul>
</nav>


<?php if($deleted_section) {?>
  <label class="mT25"><?php echo T_("Deleted section") ?> <small><?php echo T_("After saving the page, this section will be deleted completely") ?></small></label>

  <nav class="sections items">
    <ul data-sortable>
      <?php foreach ($deleted_section as $key => $value) {?>
        <li>
          <a class="item f opacity-40" href="<?php echo \dash\url::here(). '/section/'. a($value, 'section'). \dash\request::full_get(['sid' => a($value, 'id')]); ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2.5" src="<?php echo a($value, 'preview', 'icon') ?>">
            <div class="key"><?php if(a($value, 'preview', 'heading') !== null) { echo a($value, 'preview', 'heading'); }else{ echo '<i class="fc-mute">'. T_("Without title"). '</i>';} ?></div>
            <img class="p-5 opacity-70 hover:bg-gray-200" src="<?php echo \dash\utility\icon::url('Delete', 'minor'); ?>">
          </a>
        </li>
      <?php } //endfor ?>
    </ul>
  </nav>

  <?php } //endif ?>


<?php
  $html = '';

  $html .= '<div class="row w-full mt-12">';
  {
    $html .= '<div class="cauto">';
    {
      $html .= '<a tabindex=0 class="btn " href="'.\dash\url::this(). '/settings'. \dash\request::full_get().'">';
      {
        $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Settings', 'minor'). '" alt="Setting">';
        $html .= '<span class="inline-block align-middle ps-2">'. T_("Page setting").'</span>';
      }
      $html .= '</a>';
    }
    $html .= '</div>';

    $html .= '<div class="c"></div>';




    $html .= "<div class='cauto os pLa5'>";
    {
      $model_url = \dash\url::that(). '/design'. \dash\request::full_get();
      $html .= "<a href='$model_url' class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 transition p-3 rounded-lg'  title='". T_("Change Background") ."'>";
      $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Colors'). '" alt="page background">';
      $html .= '</a>';
    }
    $html .= '</div>';

  }
  $html .= '</div>';


  echo $html;
?>