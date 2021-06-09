<?php
namespace content_site\options;


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
		if(is_array(a($_section_detail, 'preview')) && array_key_exists('post_show_author', $_section_detail['preview']))
		{
			$check = $_section_detail['preview']['post_show_author'];
		}
		else
		{
			$check = self::default();
		}

		$checked = $check ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<input type="hidden" name="option" value="post_show_author">';

			$html .= '<div class="check1">';
			{
				$html .= '<input type="checkbox" name="post_show_author" id="post_show_author"'.$checked.'>';
				$html .= '<label for="post_show_author">'. T_('Show author'). '</label>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>