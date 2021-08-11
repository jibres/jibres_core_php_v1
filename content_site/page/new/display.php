<form method="post" autocomplete="off" data-patch>
  <input type="hidden" name="temptitle" value="1">
  <div class="box">
    <div class="pad pB0-f">
      <div class="mB10">
        <div class="input">
          <!-- <label><?php echo T_("Page Title") ?></label> -->
          <input type="text" name="title" id="title" value="<?php echo \dash\data::mySiteBuilderPageTitle(); ?>" placeholder='<?php echo T_("Enter Page Title"); ?>'  <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">
        </div>
      </div>
    </div>
  </div>
</form>
<?php
$html = '';
$json = json_encode(['key' => 'blank']);
$html .= "<div class='w-3/12' data-ajaxify data-data='$json'>";
{
  $html .= T_("Blank page");
  $html .= '<img src="'. \dash\sample\img::background(). '" alt="'. T_("Blank page"). '">';
}
$html .= '</div>';

if(\dash\data::templateList_preview())
{
 foreach (\dash\data::templateList_preview() as $key => $value)
 {
  $json = json_encode(['key' => a($value, 'key')]);

  $html .= "<div class='w-3/12' data-ajaxify data-data='$json'>";
  {
    $html .= a($value, 'title');
    $html .= '<img src="'. a($value, 'image'). '" alt="'. a($value, 'title'). '">';
  }
  $html .= '</div>';
 }
}

echo $html;
?>
