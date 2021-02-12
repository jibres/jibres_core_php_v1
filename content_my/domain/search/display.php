<?php
$result = '';

$result .= '<nav class="items ltr">';
$result .= '<ul>';
foreach (\dash\data::dataTable() as $key => $value)
{
    $result .= '<li>';
    $result .= '<a class="f item" href="'. \dash\url::this(). '/setting?domain='. a($value, 'name'). '">';
    $result .= '<div class="key">'. a($value, 'name'). '</div>';

    $result .= '<div class="value s0">'. a($value, 'status_text'). '</div>';

    if(isset($value['autorenew']) && $value['autorenew'])
    {
      $result .= '<i class="sf-refresh fc-blue" title="'. T_("Autorenew is active").'"></i>';
    }
    else
    {
      $result .= '<i class="sf-refresh fc-mute" title="'. T_("Autorenew is deactive").'"></i>';
    }

    if(isset($value['lock']) && $value['lock'] == 1 )
    {
      $result .= '<i class="sf-lock s0 fc-green" title="'. T_("Domain is Lock").'"></i>';
    }
    elseif(isset($value['lock']) && $value['lock'] == 0)
    {
      $result .= '<i class="sf-unlock s0 fc-red" title="'. T_("Domain is Unlock").'"></i>';
    }
    else
    {
      $result .= '<i class="sf-lock" title="'. T_("Unknown lock status").'"></i>';
    }

    $result .= '<time class="value datetime">'. \dash\fit::date(a($value, 'dateexpire')). '</time>';

    $result .= '<div class="go '. a($value, 'status_icon') .'"></div>';

    $result .= '</a>';
    $result .= '</li>';
}
$result .= '</ul>';
$result .= '</nav>';

echo $result;

\dash\utility\pagination::html();
?>