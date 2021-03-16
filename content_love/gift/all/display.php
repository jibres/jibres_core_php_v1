<?php
$result = '';
$result .= '<nav class="items">';
$result .= '<ul>';
foreach (\dash\data::dataTable() as $key => $value)
{
  $result .= '<li>';
  $result .= '<a class="f" href="'.  \dash\url::this(). '/view?id='.  a($value, 'id'). '">';
  $result .= '<div class="key txtB">'. a($value, 'code'). '</div>';
  if(a($value, 'category'))
  {
    $result .= ' <div class="value">'. a($value, 'category'). '</div>';
  }

  if(a($value, 'giftpercent'))
  {
    $result .= ' <div class="value">'. \dash\fit::number(a($value, 'giftpercent')). T_("%") .'</div>';
  }
  $result .='<time class="value">'. \dash\fit::date_time(a($value, 'datecreated')). '</time>';
  $result .= '<div class="go"></div>';
  $result .= '</a>';
  $result .= '</li>';
}
$result .= '</ul>';
$result .= '</nav>';
echo $result;
\dash\utility\pagination::html();
?>