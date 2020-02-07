<?php
namespace content_hook\device;

class controller
{
	public static function routing()
	{
		if(\dash\url::child() === null)
		{
			\dash\code::pretty(\dash\detect\device::onset());
			\dash\code::boom();
		}

	}
}
?>