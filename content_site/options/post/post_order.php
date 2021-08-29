<?php
namespace content_site\options\post;


class post_order
{

	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'latest', 'title' => T_("Newest to Oldest (default)"), ];
		$enum[] = ['key' => 'oldest', 'title' => T_("Oldest to Newest"), ];
		$enum[] = ['key' => 'random', 'title' => T_("Random posts"), 	 ];

		return $enum;
	}

	public static function validator($_data)
	{
		$data  = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Post subtype')]);
		return $data;
	}


	public static function default()
	{
		return 'latest';
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('post_order');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(__CLASS__, self::enum(), $default, T_("Order by"));
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>