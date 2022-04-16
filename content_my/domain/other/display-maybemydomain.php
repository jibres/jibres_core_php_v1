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
      $result .= '<div title="'. T_("Autorenew is active").'" class="value s0"><i class="sf-refresh fc-blue"></i></div>';
    }
    elseif((string) a($value, 'autorenew') === '0')
    {
      $result .= '<div title="'. T_("Autorenew is deactive").'" class="value s0"><i class="sf-refresh fc-mute"></i></div>';
    }
    else
    {
         if((string) a($value, 'autorenewdesign') === '1')
        {
          $result .= '<div title="'. T_("Autorenew is active").'" class="value s0"><i class="sf-refresh fc-blue"></i></div>';
        }
        elseif((string) a($value, 'autorenewdesign') === '0')
        {
          $result .= '<div title="'. T_("Autorenew is deactive").'" class="value s0"><i class="sf-refresh fc-mute"></i></div>';
        }

    }


    if(isset($value['lock']) && $value['lock'] == 1 )
    {
      $result .= '<div title="'. T_("Domain is Lock").'" class="value s0"><i class="sf-lock fc-green"></i></div>';
    }
    elseif(isset($value['lock']) && $value['lock'] == 0)
    {
      $result .= '<div title="'. T_("Domain is Unlock").'" class="value s0"><i class="sf-unlock text-red-800"></i></div>';
    }
    else
    {
      $result .= '<div title="'. T_("Unknown lock status").'" class="value s0"><i class="sf-lock"></i></div>';
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
