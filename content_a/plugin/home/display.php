<?php

$pluginList = \dash\data::pluginList();

if(!is_array($pluginList))
{
  $pluginList = [];
}

$pluginKeywords = \dash\data::pluginKeywords();

if(!is_array($pluginKeywords))
{
  $pluginKeywords = [];
}


$html = '';

foreach ($pluginKeywords as $key => $value)
{
  $html.= '<a class="btn-outline-primary mr-5" href="'. \dash\url::this(). \dash\request::full_get(['category' => $value]). '">#'. $value. '</a>';
}
if(\dash\request::get())
{
  $html.= '<a class="btn-outline-primary mr-5" href="'. \dash\url::this(). '">#'. T_("Clear filter"). '</a>';
}

/*========================================
=            search in plugin            =
========================================*/
$html .= '<form method="get" autocomplete="off" action="'.\dash\url::this().'">';
{
  $html .= '<div class="input">';
  {
    $html .= '<input type="text" name="q" value="'. \dash\request::get('q'). '">';
    $html .= '<button class="addon btn"><img class="w-3" src="'. \dash\utility\icon::url('Search'). '"></button>';
  }
  $html .= '</div>';
}
$html .= '</form>';



/*=====  End of search in plugin  ======*/


$html .= '<div class="row">';
{
  foreach ($pluginList as $key => $value)
  {
    $html .= '<div class="c-3">';
    {
      $html .= '<a class="" href="'. \dash\url::this(). '/view/'.  a($value, 'plugin_key'). '">';
      {
        $html .= '<div class="box">';
        {
          $html .= '<div class="body">';
          {
              $html .= '<div class="">'.  a($value, 'title'). '</div>';
              $html .= '<div class="">'.  \dash\fit::number(a($value, 'price')). '</div>';
          }
          $html .= '</div>';
        }
        $html .= '</div>';
      }
      $html .= '</a>';

    }
    $html .= '</div>';
  }


}
$html .= '</div>';


echo $html;

\dash\utility\pagination::html();
?>