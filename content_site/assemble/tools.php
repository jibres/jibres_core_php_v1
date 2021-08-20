<?php
namespace content_site\assemble;


class tools
{

	public static function section_id($_type, $_id)
	{
		return 'id="'.$_type. '-'. $_id.'"';
	}
}
?>