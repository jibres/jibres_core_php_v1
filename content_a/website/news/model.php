<?php
namespace content_a\website\news;

class model
{
	public static function post()
	{


		$post =
		[
			'title'   => \dash\request::post('title'),
			'publish' => 1,
			'cat_id'  => \dash\request::post('cat_id'),
		];


		if(!\dash\data::newsID())
		{
			$news = \lib\app\website\body\line\news::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($news['id']))
				{
					\dash\redirect::to(\dash\url::this(). '/news?id='. $news['id']);
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
				\lib\app\website\body\line\news::edit($post, \dash\data::newsID());
			}


			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/news?id='. \dash\data::newsID());
			}
		}
	}

}
?>
