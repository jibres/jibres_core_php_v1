<?php
namespace content_site\options\post;


class post_show_author
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
		$default = \content_site\section\view::get_current_index_detail('post_show_author');

		if(!$default)
		{
			$default = self::default();
		}

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<div class="check1 py-0">';
			{
				$html .= '<input type="checkbox" name="opt_post_show_author" id="post_show_author"'.$checked.'>';
				$html .= '<label for="post_show_author">'. T_('Show author'). '</label>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>