<?php
namespace content_cms\comments\home;


class controller
{
	public static function routing()
	{
		\dash\data::viewCommentModule(\dash\url::this(). '/view');
	}
}
?>