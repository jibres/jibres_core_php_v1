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
$html .= '<div class="row">';
{
  $html .= '<div class="c-xs-12 c-sm-4">';
  {
    $json = json_encode(['key' => 'blank']);
    $html .= "<div class='' data-ajaxify data-data='$json'>";
    {
      $html .= T_("Blank page");
      $html .= '<img src="'. \dash\sample\img::background(). '" alt="'. T_("Blank page"). '">';
    }
    $html .= '</div>';
  }
  $html .= '</div>';

    if(\dash\data::templateList_preview())
    {
     foreach (\dash\data::templateList_preview() as $key => $value)
     {
      $html .= '<div class="c-xs-12 c-sm-4">';
      {
        $json = json_encode(['key' => a($value, 'key')]);

        $html .= "<div class='' data-ajaxify data-data='$json'>";
        {
          $html .= a($value, 'title');
          $html .= '<img src="'. a($value, 'image'). '" alt="'. a($value, 'title'). '">';
        }
        $html .= '</div>';
      }
      $html .= '</div>';
     }
  }
}
$html .= '</div>';


echo $html;
?>
