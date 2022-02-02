<?php
namespace content_site\options\text;


class text_link
{
	public static function is_ul_li()
	{
		return true;
	}

	public static function admin_html()
	{
		$html = '';
		$url = \dash\url::that(). '/text'. \dash\request::full_get();

		$html .= \content_site\utility::ul_li_started(true);

   		$html .= '<li>';
   		{
      		$html .= "<a class='item f' href='$url'>";
      		{
        		$html .= '<img alt="Style" class="bg-gray-100 hover:bg-gray-200 p-1" src="'. \dash\utility\icon::url('Text'). '">';
        		$html .= '<div class="key">'. T_("Edit text"). '</div>';
        		$html .= '<div class="go"></div>';
      		}
      		$html .= '</a>';
   		}
   		$html .= '</li>';


		return $html;
	}





}
?>