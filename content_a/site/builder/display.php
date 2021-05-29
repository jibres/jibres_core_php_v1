<?php
if(\dash\data::lineSetting())
{
  \lib\pagebuilder\tools\admin_design::draw();
}
else
{
  echo '<div class="browserFrame w-full h-full shadow-lg overflow-hidden rounded-t-2xl rounded-b-md flex flex-col bg-white">';
  echo '<div class="toolbar flex-grow-0 flex-none flex content-center">';
  {
    // dots
    echo '<div class="relative flex items-center space-x-3 px-5">';
    {
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
    }
    echo '</div>';
    // address line
    echo '<div class="relative flex flex-grow items-center px-7 bg-gray-100 hover:bg-gray-200 rounded-full my-3 text-xl text-gray-700 transition">';
    {
      echo '<div class="flex-grow">';
      echo \dash\url::pwd();
      echo '</div>';

      echo '<div class="mx-2 relative flex items-center space-x-1 px-3 bg-green-200 text-gray-900 rounded-full text-base">';
      echo '<div class="w-3 h-3 mx-1 bg-green-800 rounded-full animate-ping2 opacity-50"></div>';
      echo '<div>'. T_("Live"). '</div>';
      echo '</div>';
    }
    echo '</div>';
    // zoom icon
    echo '<div class="relative flex items-center space-x-3 px-5">';
    {
      echo '<div class="sf-search-minus text-gray-300 hover:text-gray-500 text-3xl transition cursor-pointer"></div>';
    }
    echo '</div>';
  }
  echo '</div>';
  // echo '<iframe src="http://rafiei.local/"></iframe>';
  echo '<iframe class="flex-grow w-full h-full" src="http://jibres.local/billboard"></iframe>';
  echo '</div>';

  // echo '<div class="avand-md">';
  //   HTML_postDetail();
  //   HTML_header();
  //   HTML_line();
  //   HTML_footer();
  // echo '</div>';
}




function HTML_postDetail()
{
?>
<div class="msg info2 font-14 row">
  <div class="c"><?php echo a(\dash\data::lineList(), 'post_detail', 'title');?></div>
  <div class="cauto"><a href="<?php echo \dash\url::this(). '/manage'. \dash\request::full_get() ?>"><?php echo T_("Manage") ?></a></div>

</div>
<?php } //endfunction




function HTML_header()
{
  $header = [];
  if(\dash\data::lineList_list())
  {
    foreach (\dash\data::lineList_list() as $key => $value)
    {
      if(isset($value['mode']) && $value['mode'] === 'header')
      {
        $header[] = $value;
      }
    }
  }
?>

  <nav class="items">
    <ul>
      <?php if($header) {?>
        <?php foreach ($header as $key => $value) {?>
        <li>
          <a href="<?php echo \dash\url::that(). '/'. a($value,'type') . \dash\request::full_get(['pid' => a($value, 'id')]); ?>" class="f">
            <div class="key"><?php echo T_('Customize header');?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //endif ?>
      <?php }else{ ?>
        <li>
          <a class="f" href="<?php echo \dash\url::this(). '/choose/header'. \dash\request::full_get();?>">
            <div class="key"><?php echo T_('Choose header');?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } ?>
       </ul>
  </nav>
<?php } //endfunction







function HTML_line() {
  $count_body = 0;
?>
<form method="post">
  <input type="hidden" name="sortline" value="sortline">
   <nav class="items">
      <ul class="sortable" data-sortable>
      <?php foreach (\dash\data::lineList_list() as $key => $value) { if(a($value, 'mode') !== 'body'){continue;} $count_body++; ?>
         <li>
           <a href="<?php echo \dash\url::that(). '/'. a($value,'type') .\dash\request::full_get(['pid' => a($value, 'id')]); ?>" class="f">
            <input type="hidden" class="hide" name="bodyline[]" value="<?php echo a($value, 'id'); ?>">
              <div class="key">
                <div class="f">
                  <div data-handle class="cauto handle"><i class="sf-sort"></i></div>
                  <div class="c mLa10"><?php echo a($value, 'title')?></div>
                </div>
              </div>
              <div class="go"></div>
            </a>
         </li>
      <?php } //endfor ?>
    </ul>
  </nav>
</form>
  <?php if($count_body >= 2) {?>
    <div class="msg fs12"><?php echo T_("Change the position of the rows with the help of the handle") ?> <kbd><i class="sf-sort"></i></kbd></div>
  <?php } //endif ?>
<?php HTML_allNewLine(); ?>
<?php } //enddfunction




function HTML_allNewLine() {?>
<nav class="items">
  <ul>
    <li>
      <a class="f" href="<?php echo \dash\url::this(). '/additem'. \dash\request::full_get();?>">
       <div class="key fc-mute"><?php echo T_('Add new line');?></div>
       <div class="go plus ok"></div>
      </a>
    </li>
  </ul>
</nav>
<?php } //enddfunction




function HTML_footer()
{
  $footer = [];
  if(\dash\data::lineList_list())
  {
    foreach (\dash\data::lineList_list() as $key => $value)
    {
      if(isset($value['mode']) && $value['mode'] === 'footer')
      {
        $footer[] = $value;
      }
    }
  }
?>
  <nav class="items">
    <ul>
      <?php if($footer) {?>
        <?php foreach ($footer as $key => $value) {?>
        <li>
          <a href="<?php echo \dash\url::that(). '/'. a($value,'type') .\dash\request::full_get(['pid' => a($value, 'id')]); ?>" class="f">
            <div class="key"><?php echo T_('Customize footer');?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //endif ?>
      <?php }else{ ?>
        <li>
          <a class="f" href="<?php echo \dash\url::this(). '/choose/footer'. \dash\request::full_get();?>">
            <div class="key"><?php echo T_('Choose footer');?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } ?>
       </ul>
  </nav>
<?php } //endfunction?>



