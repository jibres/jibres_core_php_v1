<?php
namespace content_site\options;


class target
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit($_data);
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('target');

		if(!$default)
		{
			$default = self::default();
		}

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<input type="hidden" name="option" value="target">';

			$html .= '<div class="check1">';
			{
				$html .= '<input type="checkbox" name="target" id="target"'.$checked.'>';
				$html .= '<label for="target">'. T_('Open in new windows'). '</label>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>