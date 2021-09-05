<?php
namespace content_a\website\socialnetwork;

class model
{
	public static function post()
	{

		$post =
		[
			'title'   => \dash\request::post('title'),
			// 'sort'    => \dash\request::post('sort'),
			'publish' => 1,
		];


		if(!\dash\data::textID())
		{
			$text = \lib\app\website\body\line\socialnetwork::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($text['id']))
				{
					\dash\redirect::to(\dash\url::this(). '/socialnetwork?id='. $text['id']);
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
				\lib\app\website\body\line\socialnetwork::edit($post, \dash\data::textID());
			}


			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/socialnetwork?id='. \dash\data::textID());
			}
		}
	}


}
?>