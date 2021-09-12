<?php
  $html = '';

  $html .= '<div class="row w-full">';
  {
    $html .= '<div class="cauto">';
    {
      $html .= '<a tabindex=0 class="inline-block bg-gray-50 transition p-3 rounded-lg"  href="'.\dash\url::this(). '/settings'. \dash\request::full_get().'">';
      {
        $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Settings', 'minor'). '" alt="Setting">';
        $html .= '<span class="inline-block align-middle ps-2">'. T_("Page setting").'</span>';
      }
      $html .= '</a>';
    }
    $html .= '</div>';

    $html .= '<div class="c"></div>';




    $html .= "<div class='cauto os pLa5'>";
    {
      $model_url = \dash\url::that(). '/design'. \dash\request::full_get();
      $html .= "<a href='$model_url' class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 transition p-3 rounded-lg'  title='". T_("Change Background") ."'>";
      $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Colors'). '" alt="page background">';
      $html .= '</a>';
    }
    $html .= '</div>';

  }
  $html .= '</div>';


  echo $html;
?>