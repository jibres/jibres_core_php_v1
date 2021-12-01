<?php
namespace content_site\assemble\element;


class video
{
	public static function html($_args)
	{
		$html = '';

		$src      = a($_args, 'src');
		$videoClass = a($_args, 'class');


		return $html;
	}
}
?>