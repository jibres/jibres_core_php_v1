<?php 
if(!\dash\request::get('index') && \dash\request::get('sid') && !\dash\url::subchild())
{
    $model_url = \dash\url::that(). '/model'. \dash\request::full_get();

	$html .= '<nav class="items long mt-4">';
	{
	    $html .= '<ul>';
	    {
	      $html .= '<li>';
	      {
	          $html .= "<a class='item f' href='$model_url'>";
	          {
	            $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" alt="Replace" src="'. \dash\utility\icon::url('Replace'). '">';
	            $html .= '<div class="key">'. T_("Change to another model"). '</div>';
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