<?php
namespace content_a\website\body\quote;

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
			'quote'  => \dash\request::post('quote'),
			'url'   => \dash\request::post('url'),
			'title' => \dash\request::post('title'),
		];


		if(!\dash\data::quoteID())
		{
			$quote = \lib\app\website\body\line\quote::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($quote['id']))
				{
					\dash\redirect::to(\dash\url::that(). '/quote?id='. $quote['id']);
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
			$quote = \lib\app\website\body\line\quote::edit($post, \dash\data::quoteID());

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/quote?id='. \dash\data::quoteID());
			}
		}
	}
}
?>
