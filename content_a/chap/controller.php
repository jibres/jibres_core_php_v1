<?php
namespace content_a\chap;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('id'))
		{
			\dash\redirect::to(\dash\url::here());
		}
		elseif(\dash\url::child() === null)
		{
			\dash\redirect::to(\dash\url::this(). '/receipt?print=auto&id='. \dash\request::get('id'));
		}

		\dash\permission::access('_group_orders');

		$child = \dash\url::child();
		if(in_array($child, ['receipt', 'fishprint', 'a4', 'a5']))
		{
			\dash\open::get();
		}
	}
}
?>
