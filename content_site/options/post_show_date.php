<?php
namespace content_site\options;


class post_show_date
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
		$default = \content_site\section\view::get_current_index_detail('post_show_date');

		if(!$default)
		{
			$default = self::default();
		}

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<input type="hidden" name="option" value="post_show_date">';

			$html .= '<div class="check1">';
			{
				$html .= '<input type="checkbox" name="post_show_date" id="post_show_date"'.$checked.'>';
				$html .= '<label for="post_show_date">'. T_('Show date'). '</label>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>