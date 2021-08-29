<?php
namespace content_site\options\btn;


class btn_viewall
{

	public static function validator($_data)
	{
		$new_data                       = [];

		$new_data['btn_viewall_check'] = \dash\validate::checkbox(a($_data, 'btn_viewall_check'));
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
		$html .= \content_site\options\generate::form();
		{
	    	$html .= \content_site\options\generate::multioption();
	    	$html .= \content_site\options\generate::not_redirect();

	    	$html .= \content_site\options\generate::checkbox('opt_btn_viewall_check', T_('Show <b>View all</b> button'), $default);

			$html .= '<div class="mt-5" data-response="opt_btn_viewall_check" data-response-effect="slide"'.$data_response_hide.'>';
			{
				$html .= \content_site\options\generate::text('opt_btn_viewall', $default, null, self::default());
			}
			$html .= '</div>';
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}


}
?>