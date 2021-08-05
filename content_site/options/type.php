<?php
namespace content_site\options;


class type
{
	private static function enum()
	{
		// only in admin need to route this option
		// then we have section key in url in \dash\url::child()
		$section = \dash\url::child();

		$type_list = \content_site\call_function::type_list($section);

		if(!is_array($type_list))
		{
			return [];
		}

		$enum   = [];

		foreach ($type_list as $key => $value)
		{
			$enum[] = ['key' => a($value, 'type'), 'title' => a($value, 'title'), 'default' => a($value, 'default')];
		}

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Type')]);
		return $data;
	}


	public static function default()
	{
		$enum = self::enum();
		foreach ($enum as $key => $value)
		{
			if(isset($value['key']) && isset($value['default']) && $value['default'])
			{
				return $value['key'];
			}
		}

		return null;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('type');

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';
		$url = \dash\url::that(). '/type'. \dash\request::full_get();
		$html .= "<a href='$url' class='link text-xs mt-10 block'>". T_("Choose another preview"). '</a>';
		return $html;


		// $title = T_("Set item type");

		// $html = '';
		// $html .= '<form method="post" data-patch>';
		// {
		// 	$html .= "<label for='type'>$title</label>";
	 //        $html .= '<select name="opt_type" class="select22" id="type">';

	 //        foreach (self::enum() as $key => $value)
	 //        {
	 //        	$selected = null;

	 //        	if($value['key'] === $default)
	 //        	{
	 //        		$selected = ' selected';
	 //        	}

	 //        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
	 //        }

	 //       	$html .= '</select>';
		// }
  // 		$html .= '</form>';

		// return $html;
	}

}
?>