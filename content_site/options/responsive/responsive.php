<?php
namespace content_site\options\responsive;


class responsive
{
	public static function is_ul_li()
	{
		return true;
	}

	public static function admin_html()
	{
		$html = '';
		$url = \dash\url::that(). '/responsive'. \dash\request::full_get();

		$html .= \content_site\utility::ul_li_started(true);

   		$html .= '<li>';
   		{
      		$html .= "<a class='item f' href='$url'>";
      		{
        		$html .= '<img alt="Style" class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Desktop'). '">';
        		$html .= '<div class="key">'. T_("Responsive"). '</div>';
        		$html .= '<div class="go"></div>';
      		}
      		$html .= '</a>';
   		}
   		$html .= '</li>';


		return $html;
	}





}
?>