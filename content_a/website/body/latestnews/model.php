<?php
namespace content_a\website\body\latestnews;

class model
{
	public static function post()
	{
		if(\dash\request::post('edit_line') === 'setting')
		{
			\content_a\website\body\edit\model::post();

			if(\dash\engine\process::status())
			{
				if(\dash\request::post('remove') === 'line')
				{
					\dash\redirect::to(\dash\url::that());
				}
			}

			return;
		}


		$post =
		[
			'limit'    => \dash\request::post('limit'),
		];


		if(!\dash\data::latestnewsID())
		{
			$latestnews = \lib\app\website\body\line\latestnews::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($latestnews['id']))
				{
					\dash\redirect::to(\dash\url::that(). '/latestnews?id='. $latestnews['id']);
				}
				else
				{
					// @BUG!
					\dash\redirect::to(\dash\url::that());
				}
			}

			return;
		}
		else
		{
			$latestnews = \lib\app\website\body\line\latestnews::edit($post, \dash\data::latestnewsID());

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/latestnews?id='. \dash\data::latestnewsID());
			}
		}
	}
}
?>
