<?php
namespace content_site\options\background;


class background_attachment
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'fixed'];
		$enum[] = ['key' => 'local'];
		$enum[] = ['key' => 'scroll'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Attachment')]);
		return $data;
	}



	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_attachment');

		if(!$default)
		{
			$default = 'scroll';
		}


		$title = T_("Background Attachment Type");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_attachment'>$title</label>";
	        $html .= '<select name="opt_background_attachment" class="select22"  id="background_attachment">';

	        foreach (self::enum() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>";
	        	$html .= $value['key'];
	        	$html .= "</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>