<?php

html_site_list('homepage');
html_site_list();
function html_site_list($_type = null)
{

$code = \content_site\homepage::code();

$html = '';
$html .= '<nav class="items">';
$html .= '<ul>';
foreach (\dash\data::dataTable() as $key => $value)
{
  if($_type === 'homepage')
  {
    if(a($value, 'id') === $code)
    {
      $value['title'] = T_("Manage homepage");
      // ok
    }
    else
    {
      continue;
    }
  }
  else
  {
    if(a($value, 'id') !== $code)
    {
      // ok
    }
    else
    {
      continue;
    }
  }

  $date_title = '';
  if(a($value, 'datemodified'))
  {
    $date_title .= T_("Date modified"). ': '. \dash\fit::date_time(a($value, 'datemodified')). "\n";
  }
  if(a($value, 'publishdate'))
  {
    $date_title .= T_("Publish date"). ': '. \dash\fit::date_time(a($value, 'publishdate'));
  }

    $html .= '<li>';
    $html .= '<a class="item f align-center" href="'. \dash\url::this(). '/page?id='.  a($value, 'id'). '">';
    if(a($value, 'thumb'))
    {
       $html.= '<img src="'. \dash\fit::img(a($value, 'thumb')). '" alt="'. T_("Post image"). '">';
    }
    else
    {
      $type = 'news';
      switch (a($value, 'subtype'))
      {
        case 'standard':
          $type = 'news';
          break;

        case 'gallery':
          $type = 'picture';
          break;

        case 'video':
          $type = 'film';
          break;

        case 'audio':
          $type = 'music';
          break;

        default:
          break;
      }
    $html .= '<i class="sf-'. $type. '"></i>';
    }
    $html .= '<div class="key">'.  a($value, 'title'). '</div>';
    $html .= '<time class="value" datatime="'. $date_title. '">'. \dash\fit::date_time(a($value, 'datecreated')). '</time>';
    $html .= '<div class="go '. $value['icon_list']. '"></div>';
    $html .= '</a>';
    $html .= '</li>';


  }
  $html .= '</ul>';
  $html .= '</nav>';

  echo $html;

\dash\utility\pagination::html();
}
?>