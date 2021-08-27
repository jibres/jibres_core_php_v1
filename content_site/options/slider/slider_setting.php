<?php
namespace content_site\options\slider;


class slider_setting
{
	public static function admin_html()
	{
		$html = '';
		$url = \dash\url::that(). '/slider_setting'. \dash\request::full_get();


		$html .= '<nav class="items long mT20">';
		{
		 		$html .= '<ul>';
		 		{
		   		$html .= '<li>';
		   		{
		      		$html .= "<a class='item f' href='$url'>";
		      		{
		        		$html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Settings'). '">';
		        		$html .= '<div class="key">'. T_("Slider options"). '</div>';
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