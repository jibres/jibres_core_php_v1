<?php
namespace dash\layout;

class autofocus
{

	public static function html()
	{
		if(!\dash\detect\device::detectPWA())
		{
			if(in_array('add', [\dash\url::module(), \dash\url::child(), \dash\url::subchild()]))
			{
				echo 'autofocus';
			}
			else
			{
				if(\dash\server::referer() !== \dash\url::pwd())
				{
					echo 'autofocus';
				}
			}
		}

	}
}
?>