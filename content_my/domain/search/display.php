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


    if((string) a($value, 'autorenew') === '1')
    {
      $result .= '<i title="'. T_("Auto Renew is Enable"). '" class="sf-refresh fc-blue"></i>';
    }
    elseif((string) a($value, 'autorenew') === '0')
    {
      $result .= '<i title="'. T_("Auto Renew is Disable"). '" class="sf-refresh text-gray-400"></i>';
    }
    else
    {
         if((string) a($value, 'autorenewdesign') === '1')
        {
          $result .= '<i title="'. T_("Auto Renew is Enable"). '" class="sf-refresh fc-blue"></i>';
        }
        elseif((string) a($value, 'autorenewdesign') === '0')
        {
          $result .= '<i title="'. T_("Auto Renew is Disable"). '" class="sf-refresh text-gray-400"></i>';
        }

    }

    if(isset($value['lock']) && $value['lock'] == 1 )
    {
      $result .= '<i class="sf-lock s0 fc-green" title="'. T_("Domain is Lock").'"></i>';
    }
    elseif(isset($value['lock']) && $value['lock'] == 0)
    {
      $result .= '<i class="sf-unlock s0 text-red-800" title="'. T_("Domain is Unlock").'"></i>';
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