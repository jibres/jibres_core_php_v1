<?php
namespace content_a\website\body\text;

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
			'text'    => \dash\request::post('text'),
		];


		if(!\dash\data::textID())
		{
			$text = \lib\app\website\body\line\text::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($text['id']))
				{
					\dash\redirect::to(\dash\url::that(). '/text?id='. $text['id']);
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
			$text = \lib\app\website\body\line\text::edit($post, \dash\data::textID());

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/text?id='. \dash\data::textID());
			}
		}
	}
}
?>
