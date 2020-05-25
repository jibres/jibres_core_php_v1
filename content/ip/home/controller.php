<?php
namespace content\ip\home;

class controller
{
	public static function routing()
	{
		if(\dash\url::child())
		{
			if(\dash\url::subchild())
			{
				// do not open
			}
			else
			{
				\dash\open::get();
			}
		}
	}
}
?>