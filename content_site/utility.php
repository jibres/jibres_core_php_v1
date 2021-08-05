<?php
namespace content_site;


class utility
{
	public static function unset_option(&$_option_list, $_need_unset)
	{
		if(($myKey = array_search($_need_unset, $_option_list)) !== false)
		{
			unset($_option_list[$myKey]);
		}
	}
}
?>