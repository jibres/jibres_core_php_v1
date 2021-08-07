<?php
namespace content_site\options\post;


class post_show_readingtime
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_author'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('post_show_readingtime');

		if(!$default)
		{
			$default = self::default();
		}

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_post_show_readingtime" value="1">';

			$html .= '<div class="check1 py-0">';
			{
				$html .= '<input type="checkbox" name="show_author" id="post_show_readingtime"'.$checked.'>';
				$html .= '<label for="post_show_readingtime">'. T_('Display estimated reading time'). '</label>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>