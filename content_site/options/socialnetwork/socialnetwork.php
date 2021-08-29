<?php
namespace content_site\options\socialnetwork;


class socialnetwork
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'display_socialnetwork'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('socialnetwork');

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_socialnetwork" value="1">';

			$html .= \content_site\options\generate::checkbox('display_socialnetwork', T_('Display Social Networks ID'), $default);

			$data_response_hide = 'data-response-hide';

			if($default)
			{
				$data_response_hide = null;
			}

			$html .= "<div data-response='display_socialnetwork' $data_response_hide>";
			{
				$html .= '<nav class="items long mT20"><ul>';
				{
			   		$html .= '<li>';
			   		{
			   			$url = \lib\store::admin_url(). '/a/setting/social';
			      		$html .= "<a target='_blank' class='item f' href='$url'>";
			      		{
			        		$html .= '<img alt="socialnetwork" class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Affiliate'). '">';
			        		$html .= '<div class="key">'. T_("Manage socialnetwork"). '</div>';
			        		$html .= '<div class="go"></div>';
			      		}
			      		$html .= '</a>';
			   		}
			   		$html .= '</li>';
				}
				$html .= '</ul></nav>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>