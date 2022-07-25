<?php
    $html = '';
    if(\dash\data::currentPageDetail_status() === 'draft')
    {
      $html .= '<a href="'.\dash\url::this(). '/settings'. \dash\request::full_get() .'"><div class="alert-info font-14a">';
      {
        $html .= T_("This page is a draft and not published yet. You must publish it if you want it visible to everyone");
      }
      $html .= '</div></a>';
    }

    $html .= '<div>';
    {
      $html .= '<a class="btn-outline-dark btn-sm flex align-center" href="'.\dash\url::this(). '/duplicate'. \dash\request::full_get().'">';
      {
        $html .= '<img class="w-6" src="'. \dash\utility\icon::url('Duplicate', 'minor'). '" alt="Setting">';
        $html .= '<span class="px-2">'. T_("Duplicate").'</span>';
      }
      $html .= '</a>';

      $html .= '<a class="btn-outline-dark btn-sm flex align-center mt-2" href="'.\dash\url::this(). '/settings'. \dash\request::full_get().'">';
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