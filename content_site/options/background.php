<?php
namespace content_site\options;


class background
{


	public static function admin_html()
	{
		$html = '';
		$html .= '<nav class="items mT20">';
		{
	  		$html .= '<ul>';
	  		{
	    		$html .= '<li>';
	    		{
	    			$link = \dash\url::that(). '/background'. \dash\request::full_get();

		      		$html .= "<a class='item f' href='$link'>";
		      		{
		        		$html .= '<img src="'. \dash\utility\icon::url('Colors', 'major'). '">';
		        		$html .= '<div class="key">'. T_("Background"). '</div>';
		        		$html .= '<div class="go"></div>';
		      		}
		      		$html .= '</a>';
	    		}
	    		$html .= '</li>';
	  		}
	  		$html .= '</ul>';
		}
		$html .= '</nav>';

		return $html;
	}

}
?>