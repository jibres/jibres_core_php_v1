<?php
$code = \content_site\homepage::code();

if($code)
{

	$html = '';
	$html .= '<nav class="items">';
	{
		$html .= '<ul>';
		{
		    $html .= '<li>';
		    {
			    $html .= '<a class="item f align-center" href="'. \dash\url::this(). '/page?id='.  $code. '">';
			    {
				    $html .= '<i class="sf-homepage"></i>';
				    $html .= '<div class="key">'. T_("Manage homepage"). '</div>';
				    $html .= '<div class="go detail ok"></div>';
			    }
			    $html .= '</a>';
		    }
		    $html .= '</li>';
		}
	  	$html .= '</ul>';
	}
  	$html .= '</nav>';

  echo $html;

}
?>
