<?php
$result = '';

$result .= '<nav class="items ltr">';
$result .= '<ul>';
foreach (\dash\data::dataTable() as $key => $value)
{
    $result .= '<li>';
    $result .= '<a class="f item" href="'. \dash\url::this(). '/setting?domain='. a($value, 'name'). '">';
    $result .= '<div class="key">'. a($value, 'name'). '</div>';

    $result .= '<time class="value datetime">'. \dash\fit::date(a($value, 'dateexpire')). '</time>';

    $result .= '<div class=" '. a($value, 'status_icon') .'"></div>';

    $result .= '</a>';
    $result .= '</li>';
}
$result .= '</ul>';
$result .= '</nav>';

echo $result;

\dash\utility\pagination::html();
?>
