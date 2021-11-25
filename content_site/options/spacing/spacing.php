<?php
namespace content_site\options\spacing;


class spacing
{
	public static function is_ul_li()
	{
		return true;
	}

	public static function admin_html()
	{
		$html = '';
		$url = \dash\url::that(). '/spacing'. \dash\request::full_get();

		$html .= \content_site\utility::ul_li_started(true);

   		$html .= '<li>';
   		{
      		$html .= "<a class='item f' href='$url'>";
      		{
        		$html .= '<img alt="Style" class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('distribute-vertical', 'bootstrap'). '">';
        		$html .= '<div class="key">'. T_("Spacing"). '</div>';
        		$html .= '<div class="go"></div>';
      		}
      		$html .= '</a>';
   		}
   		$html .= '</li>';


		return $html;
	}





}
?>