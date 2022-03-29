<?php
namespace content_site\options\header;


class header_change
{


	public static function admin_html()
	{
		$html = '';
		$html .= '<nav class="items mt-2">';
		{
	  		$html .= '<ul>';
	  		{
	    		$html .= '<li>';
	    		{
	    			$link = \dash\url::this(). \dash\request::full_get(['list' => 'header', 'section' => null]);

		      		$html .= "<a class='item f' href='$link'>";
		      		{
		        		$html .= '<img src="'. \dash\utility\icon::url('Exchange'). '">';
		        		$html .= '<div class="key">'. T_("Change header"). '</div>';
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