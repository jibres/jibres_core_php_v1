<?php
namespace dash\layout\post;


class part
{
	public static function title($_heading = 2)
	{
		return '<h'. $_heading. '>'. \dash\data::dataRow_title(). '</h'. $_heading. '>';
	}

}
?>
