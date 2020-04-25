<?php
namespace content\domains\home;


class controller
{
	public static function routing()
	{
		if((\dash\url::child() === 'renew' || \dash\url::child() === 'transfer') && !\dash\url::subchild() )
		{
			\dash\redirect::to(\dash\url::kingdom(). '/my/domain/'. \dash\url::child());
		}
	}
}
?>