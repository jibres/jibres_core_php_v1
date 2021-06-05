<?php
namespace lib\sitebuilder;


class options
{
	public static function admin_html($_options, $_section_detail)
	{
		$html = '';

		foreach ($_options as $option)
		{
			$fn = ['\\lib\\sitebuilder\\options\\'. $option, 'admin_html'];

			if(is_callable($fn))
			{
				$html .= call_user_func($fn, [$_section_detail]);
			}
		}

		return $html;
	}
}
?>