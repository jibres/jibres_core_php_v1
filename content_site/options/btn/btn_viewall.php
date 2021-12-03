<?php
namespace content_site\options\btn;


class btn_viewall
{

	public static function validator($_data)
	{
		$new_data                       = [];

		$new_data['btn_viewall_check'] = \dash\validate::checkbox(a($_data, 'btninpucheck'));
		$new_data['btn_viewall']       = \dash\validate::string_100(a($_data, 'btn_viewall'));

		return $new_data;
	}


	public static function default()
	{
		return T_("View all");
	}


	public static function admin_html($_section_detail)
	{
		$data_response_hide = ' data-response-hide';

		$checked = \content_site\section\view::get_current_index_detail('btn_viewall_check');

		if($checked)
		{
			$data_response_hide = null;
		}

		$default = \content_site\section\view::get_current_index_detail('btn_viewall');
		if(!$default)
		{
			$default = static::default();
		}


		$html = '';
		$html .= \content_site\options\generate::form();
		{
	    	$html .= \content_site\options\generate::multioption();
	    	$html .= \content_site\options\generate::not_redirect();
	    	$html .= \content_site\options\generate::hidden('opt_btn_viewall_check', 1);

	    	$html .= \content_site\options\generate::checkbox('btninpucheck', T_('Show <b>View all</b> button'), $checked);

			$html .= '<div class="mt-5" data-response="btninpucheck" data-response-effect="slide"'.$data_response_hide.'>';
			{
				$html .= \content_site\options\generate::text('opt_btn_viewall', $default, null, static::default());
			}
			$html .= '</div>';
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}


}
?>