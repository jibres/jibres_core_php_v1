<?php
namespace content_a\website\productline;

class model
{
	public static function post()
	{


		$post =
		[
			'title'   => \dash\request::post('title'),
			'publish' => 1,
			'type'    => \dash\request::post('type'),
			'cat_id'  => \dash\request::post('cat_id'),
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
			if(\dash\request::post('remove') === 'line')
			{
				\lib\app\website\body\remove::line(\dash\request::get('id'));
				\dash\redirect::to(\dash\url::this(). '/body');
				return;
			}
			else
			{
				\lib\app\website\body\line\productline::edit($post, \dash\data::productlineID());
			}


			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/productline?id='. \dash\data::productlineID());
			}
		}
	}

}
?>
