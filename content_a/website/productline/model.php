<?php
namespace content_a\website\productline;

class model
{
	public static function post()
	{

		$post =
		[
			'limit'    => \dash\request::post('limit'),
		];


		if(!\dash\data::productlineID())
		{
			$productline = \lib\app\website\body\line\productline::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($productline['id']))
				{
					\dash\redirect::to(\dash\url::this(). '/productline?id='. $productline['id']);
				}
				else
				{
					// @BUG!
					\dash\redirect::to(\dash\url::this());
				}
			}

			return;
		}
		else
		{
			$productline = \lib\app\website\body\line\productline::edit($post, \dash\data::productlineID());

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/productline?id='. \dash\data::productlineID());
			}
		}
	}

}
?>
