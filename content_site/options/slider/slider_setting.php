<?php
namespace content_site\options\slider;


class slider_setting
{

	public static function is_ul_li()
	{
		return true;
	}


	public static function admin_html()
	{
		$html = '';
		$url = \dash\url::that(). '/slider_setting'. \dash\request::full_get();

		$html .= \content_site\utility::ul_li_started(true);

   		$html .= '<li>';
   		{
      		$html .= "<a class='item f' href='$url'>";
      		{
        		$html .= '<img alt="Setting" class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('slideshow'). '">';
        		$html .= '<div class="key">'. T_("Slider options"). '</div>';
        		$html .= '<div class="go"></div>';
      		}
      		$html .= '</a>';
   		}
   		$html .= '</li>';


		return $html;
	}





}
?>