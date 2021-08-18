<?php
namespace content_site\options;


class type
{
	private static function enum()
	{
		// only in admin need to route this option
		// then we have section key in url in \dash\url::child()
		$section = \dash\url::child();

		$type_list = \content_site\call_function::type_list($section);

		if(!is_array($type_list))
		{
			return [];
		}

		return $type_list;

	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => self::enum(), 'field_title' => T_('Type')]);
		return $data;
	}




	public static function admin_html()
	{

		$html = '';
		$url = \dash\url::that(). '/type'. \dash\request::full_get();


		$html .= '<nav class="items long mT20">';
		{
	 		$html .= '<ul>';
	 		{
		   		$html .= '<li>';
		   		{
		      		$html .= "<a class='item f' href='$url'>";
		      		{
		        		$html .= '<img alt="" class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Exchange'). '">';
		        		$html .= '<div class="key">'. T_("Choose another preview"). '</div>';
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