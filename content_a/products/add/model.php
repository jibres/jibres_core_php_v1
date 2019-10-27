<?php
namespace content_a\products\add;


class model
{
	public static function post()
	{
		$post = \content_a\products\edit\model::get_post();

		$result = \lib\app\product\add::add($post);
		if(!$result)
		{
			return false;
		}

		if(isset($result['code']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?code='. $result['code']);
		}
		else
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>