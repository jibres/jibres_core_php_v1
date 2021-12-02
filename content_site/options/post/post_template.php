<?php
namespace content_site\options\post;


class post_template
{

	private static function enum_post_template()
	{
		$enum   = [];
		$enum[] = ['key' => 'any',		'title' => T_("Any"), 		];
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
		$enum[] = ['key' => 'first','title' => T_("First"), ];
		$enum[] = ['key' => 'all', 	'title' => T_("All"), 	];

		return $enum;
	}


	public static function validator($_data)
	{

		$new_data                   = [];
		$new_data['post_template']  = \dash\validate::enum(a($_data, 'post_template'), true, ['enum' => array_column(self::enum_post_template(), 'key'), 'field_title' => T_('Post subtype')]);
		$new_data['post_play_item'] = \dash\validate::enum(a($_data, 'post_play_item'), true, ['enum' => array_column(self::enum_post_play_item(), 'key'), 'field_title' => T_('Play Item')]);
		return $new_data;
	}


	public static function default()
	{
		return 'any';
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
			$default_post_template = self::default();
		}

		if(isset($_section_detail['preview']['post_play_item']) && $_section_detail['preview']['post_play_item'])
		{
			$default_play_item = $_section_detail['preview']['post_play_item'];
		}
		else
		{
			$default_play_item = null;
		}

		$subtypeSearchLink = \dash\url::kingdom(). '/cms/posts';

		if($default_post_template  && $default_post_template !== 'any')
		{
			$subtypeSearchLink .= '?subtype='. $default_post_template;
		}


		$html = '';
		$html .= \content_site\options\generate::form();
		{
	    	$html .= \content_site\options\generate::multioption();

	    	$html .= "<div class='row'>";
			{
				$html .= "<div class='c'>";
				{
	    			$html .= "<label for='post_template'>". T_("Filter by post type") ."</label>";
				}
				$html .= "</div>";

				$html .= "<div class='c-auto'>";
				{
					$html .= "<a target='_blank' class='link'  href='$subtypeSearchLink'><i class='sf-external-link'></i></a>";
				}
				$html .= "</div>";
			}
			$html .= "</div>";

			$html .= \content_site\options\generate::select(get_called_class(), self::enum_post_template(), $default_post_template);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>