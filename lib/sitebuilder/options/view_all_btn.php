<?php
namespace lib\sitebuilder\options;


class view_all_btn
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}


	public static function default()
	{
		return T_("View all");
	}


	public static function admin_html($_section_detail)
	{
		$checked            = null;
		$data_response_hide = ' data-response-hide';

		if(isset($_section_detail['preview']['view_all_btn']) && $_section_detail['preview']['view_all_btn'])
		{
			$default            = $_section_detail['preview']['view_all_btn'];
			$checked            = ' checked';
			$data_response_hide = null;
		}
		else
		{
			$default = self::default();
		}


		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
    	$html .= '<input type="hidden" name="option" value="view_all_btn">';

		$html .= '<div class="check1">';
		{
			$html .= '<input type="checkbox" name="view_all_btn_check" id="view_all_btn_check"'.$checked.'>';
			$html .= '<label for="view_all_btn_check">'. T_('Show "View all" button'). '</label>';
		}
		$html .= '</div>';

		$html .= '<div data-response="view_all_btn_check" data-response-effect="slide"'.$data_response_hide.'>';
		{
			$html .= '<div class="input">';
			{
				$html .= '<input type="text" name="view_all_btn" placeholder="'.$default.'" value="'.$default.'">';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

  		$html .= '</form>';

		return $html;
	}

}
?>