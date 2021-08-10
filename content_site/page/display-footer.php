<?php
  $html = '';
  $html .= '<a class="row w-full" href="'.\dash\url::this(). '/settings'. \dash\request::full_get().'">';
  $html .= '<div class="cauto">';
  $html .= "<div tabindex=0 class='inline-block bg-gray-50 transition p-3 rounded-lg'>";
  $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Settings', 'minor'). '" alt="Setting">';
  $html .= '<span class="inline-block align-middle ps-2">'. T_("Page setting").'<span>';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '<div class="c"></div>';
  $html .= "<div class='cauto os' >";
  $html .= '</div>';
  $html .= '</a>';

  echo $html;
?>