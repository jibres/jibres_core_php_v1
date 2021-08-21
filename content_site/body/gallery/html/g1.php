<?php
namespace content_site\body\gallery\html;


class g1
{
	public static function html($_args, $_image_list)
	{
		$_args['post_show_image'] = true;

		foreach ($_image_list as $key => $value)
		{
			$_image_list[$key]['thumb'] = a($value, 'image');
			$_image_list[$key]['title'] = a($value, 'caption');
		}

		return \content_site\body\blog\html\b2::html($_args, $_image_list);
	}
}
?>