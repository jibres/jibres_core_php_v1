<?php
namespace content_site\options\post;


class post_tag
{

	public static function validator($_data)
	{
		$data = \dash\validate::code_0($_data);
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail)
	{

		$tag_list = \dash\app\terms\get::get_all_tag();

		$default = \content_site\section\view::get_current_index_detail('post_tag');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Special tag");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='post_tag'>$title</label>";
	        $html .= '<select name="opt_post_tag" class="select22" id="post_tag" data-placeholder="'. T_("Select tag"). '">';

			if(a($_section_detail, 'preview', 'post_tag'))
			{
				$html .= '<option value="0">'. T_("None"). '</option>';
			}
			else
			{
				$html .= '<option value="">'. T_("Select tag"). '</option>';
			}

	        foreach ($tag_list as $key => $value)
	        {
	        	$selected = null;

	        	if($value['id'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[id]'$selected>$value[title]</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>