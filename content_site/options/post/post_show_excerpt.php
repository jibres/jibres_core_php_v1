<?php
namespace content_site\options\post;


class post_show_excerpt
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_excerpt'));
		return $data;
	}


	public static function default()
	{
		return true;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('post_show_excerpt');

		if(!$default)
		{
			$default = self::default();
		}

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_post_show_excerpt" value="1">';
			$html .= '<div class="check1 py-0">';
			{
				$html .= '<input type="checkbox" name="show_excerpt" id="post_show_excerpt"'.$checked.'>';
				$html .= '<label for="post_show_excerpt">'. T_('Show excerpt'). '</label>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>