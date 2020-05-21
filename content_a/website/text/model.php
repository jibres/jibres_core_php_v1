<?php
namespace content_a\website\text;

class model
{
	public static function post()
	{

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
					\dash\redirect::to(\dash\url::this(). '/text?id='. $text['id']);
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
			$text = \lib\app\website\body\line\text::edit($post, \dash\data::textID());

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/text?id='. \dash\data::textID());
			}
		}
	}

}
?>
