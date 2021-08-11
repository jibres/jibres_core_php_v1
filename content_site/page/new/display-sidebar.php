<?php
$html = '';
if(\dash\data::templateList_category())
{
 foreach (\dash\data::templateList_category() as $key => $value)
 {
  $html .= 'Hi';
  $html .= '<img src="'. a($value, 'image'). '" alt="'. a($value, 'title'). '">';
 }
}

echo $html;
?>
