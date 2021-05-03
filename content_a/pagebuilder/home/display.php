<?php
$html = '';

$homepage_id     = \lib\pagebuilder\tools\homepage::id();
$encode_homepage = \dash\coding::encode($homepage_id);



    $html .= '<section class="f" data-option="hoempage">';
    $html .= '<div class="c8 s12">';
    $html .= '<div class="data">';
    $html .= '<h3>'. T_("Manage website homepage"). '</h3>';
    $html .= '<div class="body">';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="c4 s12">';
    $html .= '<div class="action">';
    $html .= '<a class="btn master" href="'. \dash\url::this(). '/build?id='. $encode_homepage. '">'. T_("Manage homepage"). '</a>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</section>';


$html .= '<nav class="items">';
$html .= '<ul>';
foreach (\dash\data::dataTable() as $key => $value)
{

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
    $html .= '<a class="item f align-center" href="'. \dash\url::this(). '/build?id='.  a($value, 'id'). '">';
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
    $html .= '<div class="key">'. a($value, 'title'). '</div>';
    $html .= '<time class="value" datatime="'. $date_title. '">'. \dash\fit::date_time(a($value, 'datecreated')). '</time>';
    $html .= '<div class="go '. $value['icon_list']. '"></div>';
    $html .= '</a>';
    $html .= '</li>';
  }
  $html .= '</ul>';
  $html .= '</nav>';

  echo $html;

\dash\utility\pagination::html();
?>