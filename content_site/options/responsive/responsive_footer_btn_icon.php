<?php
namespace content_site\options\responsive;


class responsive_footer_btn_icon
{
	public static function validator($_data)
	{
		$data = \dash\validate::enum(a($_data, 'icon'), false, ['enum' => self::icon_list()]);
		\content_site\utility::need_redirect(true);
		return ['icon' => $data];
	}

	public static function db_key()
	{
		return 'icon';
	}


	public static function icon_list()
	{
		return \content_site\icon\view::icon_list();
	}



	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('icon');

		$html = '';
		$html .= '<nav class="items">';
		{
	  		$html .= '<ul data-sortable>';
	  		{
	      		$html .= '<li>';
	      		{
		      		$html .= '<a class="item f" href="'. \dash\url::here(). '/icon'. \dash\request::full_get(['opt_responsive_footer_btn_icon' => 1, 'multioption' => 'multi', 'callback' => \dash\url::path(), 'selected' => $default]). '">';
		      		{
			            $icon = 'Home';

		      			if($default)
		      			{
		        			$icon = $default;
		      			}

		        		$icon_url = \dash\utility\icon::url($icon, 'major');

		        		$html .= '<img src="'. $icon_url. '" alt="Current Icon">';
		        		$html .= '<div class="key">'. T_("Icon :val", ['val' => $icon]).' </div>';
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
