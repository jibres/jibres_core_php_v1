<?php
namespace content_site\assemble;


class tools
{

	public static function section_id($_model, $_id)
	{
		return 'id="'.$_model. '-'. $_id.'"';
	}
}
?>