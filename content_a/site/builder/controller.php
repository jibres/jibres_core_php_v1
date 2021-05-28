<?php
namespace content_a\site\builder;


class controller
{
	public static function routing()
	{
		$subchild    = \dash\url::subchild();

		if($subchild)
		{
			\lib\pagebuilder\tools\admin_design::route();
		}
		else
		{
			if(!\dash\request::get('id'))
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}
}
?>