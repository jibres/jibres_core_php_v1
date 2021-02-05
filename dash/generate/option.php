<?php
namespace dash\generate;

class option
{
	public static function lastModified($_date = null)
	{
    $result = '<time datatime="'. $_date .'">';
    $result .= T_("This setting was last changed a :val", ['val' => \dash\fit::date_human($_date)]);
    $result .= '</time>';
    return $result;
	}
}
?>