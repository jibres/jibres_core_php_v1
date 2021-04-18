<?php
if(\dash\data::lineSetting())
{
  \lib\app\pagebuilder\line\design::draw();
}
else
{
  echo '<div class="avand-md">';
  HTML_header();
  if(\dash\data::lineList())
  {
    HTML_line();
  }
  else
  {
    HTML_allNewLine();
    // no any line list
  }
  HTML_footer();
  echo '</div>';
}


function HTML_header() {?>
<div class="avand-md">
  <nav class="items">
    <ul>
      <?php if(\dash\data::issetHeader()) {?>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/header">
            <div class="key"><?php echo T_('Customize header');?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php }else{ ?>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/choose/header">
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
      <?php foreach (\dash\data::lineList() as $key => $value) {?>
         <li>
           <a href="<?php echo \dash\url::this(). '/'. a($value,'type') .'?id='. a($value, 'id'); ?>" class="f">
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
      <a class="f" href="<?php echo \dash\url::this();?>/add">
       <div class="key"><?php echo T_('Add new line');?></div>
       <div class="go plus ok"></div>
      </a>
    </li>
  </ul>
</nav>
<?php } //enddfunction




function HTML_footer() {?>
<nav class="items">
    <ul>

      <?php if(\dash\data::issetFooter()) {?>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/footer">
            <div class="key"><?php echo T_('Customize footer');?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php }else{ ?>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/choose/footer">
            <div class="key"><?php echo T_('Choose footer');?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } ?>
        </ul>
  </nav>
<?php } //endfunction ?>