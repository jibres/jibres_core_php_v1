<?php
if(\dash\data::lineSetting())
{
  \lib\pagebuilder\tools\admin_design::draw();
}
else
{
  echo '<div class="avand-md">';
    HTML_header();
    HTML_line();
    HTML_footer();
  echo '</div>';
}


function HTML_header()
{
  $header = [];
  if(\dash\data::lineList())
  {
    foreach (\dash\data::lineList() as $key => $value)
    {
      if(isset($value['mode']) && $value['mode'] === 'header')
      {
        $header[] = $value;
      }
    }
  }
?>
<div class="avand-md">
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







function HTML_line() {?>
<form method="post">
  <input type="hidden" name="sortline" value="sortline">
   <nav class="items">
      <ul class="sortable" data-sortable>
      <?php foreach (\dash\data::lineList() as $key => $value) { if(a($value, 'mode') !== 'body'){continue;} ?>
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
  <?php if(is_array(\dash\data::lineList()) && count(\dash\data::lineList()) >= 2) {?>
    <div class="msg fs12"><?php echo T_("Change the position of the rows with the help of the handle") ?> <kbd><i class="sf-sort"></i></kbd></div>
  <?php } //endif ?>
<?php HTML_allNewLine(); ?>
<?php } //enddfunction




function HTML_allNewLine() {?>
<nav class="items">
  <ul>
    <li>
      <a class="f" href="<?php echo \dash\url::that();?>/add">
       <div class="key"><?php echo T_('Add new line');?></div>
       <div class="go plus ok"></div>
      </a>
    </li>
  </ul>
</nav>
<?php } //enddfunction




function HTML_footer()
{
  $footer = [];
  if(\dash\data::lineList())
  {
    foreach (\dash\data::lineList() as $key => $value)
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
<?php } //endfunction ?>