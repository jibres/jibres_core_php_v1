<?php 

if(\dash\permission::supervisor() && !\dash\url::subchild() && \dash\url::child())
{
  $html .= '<nav class="items long mt-4">';
  {
      $html .= '<ul>';
      {
        $html .= '<li>';
        {
            $downloadJsonSupervisor = \dash\url::current(). \dash\request::full_get(['downloadjson' => 1]);

            $myFile = \dash\url::child(). '-'. \dash\request::get('sid'). '.php';
            $html .= "<a href='$downloadJsonSupervisor' class='item f' download='$myFile' target='_blank'>";
            {
              $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" alt="code" src="'. \dash\utility\icon::url('Code'). '">';
              $html .= '<div class="key">'. T_("Download PHP"). '</div>';
              $html .= '<div class="go"></div>';
            }
            $html .= '</a>';
        }
        $html .= '</li>';
      }
      $html .= '</ul>';
  }
  $html .= '</nav>';

}
?>