<?php
namespace content_n\home;

class view
{
	public static function config()
	{
		if(\dash\data::dataRow_link() && \dash\data::dataRow_link() != \dash\url::this())
		{
			// set url canonical \dash\data::dataRow_link();
		}
	}
}
?>