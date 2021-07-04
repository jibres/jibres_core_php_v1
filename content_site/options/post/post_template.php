<?php
namespace content_site\options\post;


class post_template
{

	private static function enum_post_template()
	{
		$enum   = [];
		$enum[] = ['key' => 'standard', 'title' => T_("Standard"), 	];
		$enum[] = ['key' => 'gallery', 	'title' => T_("Gallery"), 	];
		$enum[] = ['key' => 'video', 	'title' => T_("Video"), 	];
		$enum[] = ['key' => 'audio', 	'title' => T_("Audio"), 	];

		return $enum;
	}


	private static function enum_post_play_item()
	{
		$enum   = [];
		$enum[] = ['key' => 'none', 'title' => T_("None"), 	];
		$enum[] = ['key' => 'first', 'title' => T_("First"),];
		$enum[] = ['key' => 'all', 	'title' => T_("All"), 	];

		return $enum;
	}


	public static function validator($_data)
	{
		$new_data                   = [];
		$new_data['post_template']   = \dash\validate::enum(a($_data, 'post_template'), true, ['enum' => array_column(self::enum_post_template(), 'key'), 'field_title' => T_('Post subtype')]);
		$new_data['post_play_item'] = \dash\validate::enum(a($_data, 'post_play_item'), true, ['enum' => array_column(self::enum_post_play_item(), 'key'), 'field_title' => T_('Play imte')]);
		return $new_data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail)
	{



		$data_response_hide = ' data-response-hide';

		if(isset($_section_detail['preview']['post_template']) && in_array($_section_detail['preview']['post_template'], ['video']))
		{
			$data_response_hide = null;
		}

		if(isset($_section_detail['preview']['post_template']) && $_section_detail['preview']['post_template'])
		{
			$default_post_template = $_section_detail['preview']['post_template'];
		}
		else
		{
			$default_post_template = null;
		}

		if(isset($_section_detail['preview']['post_play_item']) && $_section_detail['preview']['post_play_item'])
		{
			$default_play_item = $_section_detail['preview']['post_play_item'];
		}
		else
		{
			$default_play_item = null;
		}


		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<input type="hidden" name="multioption" value="multi">';


	    	$html .= "<label for='post_template'>". T_("Post template") ."</label>";
	        $html .= '<select name="opt_post_template" class="select22" id="post_template">';

	        foreach (self::enum_post_template() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default_post_template)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
	        }
	        $html .= '</select>';

			$html .= '<div data-response="post_template" data-response-where="video" '.$data_response_hide.'>';
			{

				$html .= "<label for='post_play_item'>". T_("Show item in player") ."</label>";
		        $html .= '<select name="post_play_item" class="select22" id="post_play_item">';
		        foreach (self::enum_post_play_item() as $key => $value)
		        {
		        	$selected = null;

		        	if($value['key'] === $default_play_item)
		        	{
		        		$selected = ' selected';
		        	}

		        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
		        }
		        $html .= '</select>';
			}

			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>