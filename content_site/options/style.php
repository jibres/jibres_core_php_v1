<?php
namespace content_site\options;


class style
{
	public static function admin_html($_section_detail)
	{
		$html = '';
		$url = \dash\url::that(). '/style'. \dash\request::full_get();


		$html .= '<nav class="items long mT20">';
		{
		 		$html .= '<ul>';
		 		{
		   		$html .= '<li>';
		   		{
		      		$html .= "<a class='item f' href='$url'>";
		      		{
		        		$html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Wand'). '">';
		        		$html .= '<div class="key">'. T_("Personalization Desgin"). '</div>';
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