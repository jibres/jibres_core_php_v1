<?php
namespace content_site\options\btn;


class btn_viewall
{

	public static function validator($_data)
	{
		$new_data                       = [];

		$new_data['btn_viewall_check'] = \dash\validate::bit(a($_data, 'btn_viewall_check'));
		$new_data['btn_viewall']       = \dash\validate::string_100(a($_data, 'btn_viewall'));

		return $new_data;
	}


	public static function default()
	{
		return T_("View all");
	}


	public static function admin_html($_section_detail)
	{
		$checked            = null;
		$data_response_hide = ' data-response-hide';

		if(isset($_section_detail['preview']['btn_viewall_check']) && $_section_detail['preview']['btn_viewall_check'])
		{
			$checked            = ' checked';
			$data_response_hide = null;
		}

		if(isset($_section_detail['preview']['btn_viewall']) && $_section_detail['preview']['btn_viewall'])
		{
			$default            = $_section_detail['preview']['btn_viewall'];
		}
		else
		{
			$default = self::default();
		}


		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<input type="hidden" name="multioption" value="multi">';
	    	$html .= '<input type="hidden" name="not_redirect" value="1">';

	    	$html .= \content_site\options\generate::checkbox('opt_btn_viewall_check', T_('Show <b>View all</b> button'), $default);

			$html .= '<div class="mt-5" data-response="opt_btn_viewall_check" data-response-effect="slide"'.$data_response_hide.'>';
			{
				$html .= '<div class="input">';
				{
					$html .= '<input type="text" name="opt_btn_viewall" placeholder="'.self::default().'" value="'.$default.'">';
				}
				$html .= '</div>';

			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}


}
?>