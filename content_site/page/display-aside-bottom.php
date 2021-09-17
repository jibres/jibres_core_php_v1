<?php
    $html = '';
    $html .= '<div">';
    {
      $html .= '<a class="btn-outline-dark btn-sm flex align-center" href="'.\dash\url::this(). '/settings'. \dash\request::full_get().'">';
      {
        $html .= '<img class="w-6" src="'. \dash\utility\icon::url('Settings', 'minor'). '" alt="Setting">';
        $html .= '<span class="px-2">'. T_("Page setting").'</span>';
      }
      $html .= '</a>';

      $model_url = \dash\url::that(). '/design'. \dash\request::full_get();
      $html .= "<a href='$model_url' class='btn-outline-dark btn-sm flex align-center mt-2'  title='". T_("Change Background") ."'>";
      $html .= '<img class="w-6" src="'. \dash\utility\icon::url('Colors'). '" alt="page background">';
        $html .= '<span class=" px-2">'. T_("Personalize").'</span>';
      $html .= '</a>';
    }
    $html .= '</div>';


    echo $html;
  ?>