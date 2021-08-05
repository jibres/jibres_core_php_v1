<?php
namespace content_site\options\post;


class post_order
{

	private static function enum_post_order()
	{
		$enum   = [];
		$enum[] = ['key' => 'latest',		'title' => T_("Latest"), 		];
		$enum[] = ['key' => 'random', 'title' => T_("Random"), 	];

		return $enum;
	}

	public static function validator($_data)
	{
		$data  = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum_post_order(), 'key'), 'field_title' => T_('Post subtype')]);
		return $data;
	}


	public static function default()
	{
		return 'latest';
	}


	public static function admin_html($_section_detail)
	{
		if(isset($_section_detail['preview']['post_order']) && $_section_detail['preview']['post_order'])
		{
			$default_post_order = $_section_detail['preview']['post_order'];
		}
		else
		{
			$default_post_order = null;
		}


		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{

	    	$html .= "<label for='post_order'>". T_("Post Order") ."</label>";
	        $html .= '<select name="opt_post_order" class="select22" id="post_order">';

	        foreach (self::enum_post_order() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default_post_order)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
	        }
	        $html .= '</select>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>