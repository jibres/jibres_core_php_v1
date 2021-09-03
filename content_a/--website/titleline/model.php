<?php
namespace content_a\website\titleline;

class model
{
	public static function post()
	{

		$post =
		[

			// 'sort'    => \dash\request::post('sort'),
			'publish' => 1,
			'titleline'    => \dash\request::post('titleline'),
		];


		if(!\dash\data::titlelineID())
		{
			$titleline = \lib\app\website\body\line\titleline::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($titleline['id']))
				{
					\dash\redirect::to(\dash\url::this(). '/titleline?id='. $titleline['id']);
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
				\lib\app\website\body\line\titleline::edit($post, \dash\data::titlelineID());
			}


			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/titleline?id='. \dash\data::titlelineID());
			}
		}
	}


}
?>
