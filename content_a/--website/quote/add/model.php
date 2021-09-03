<?php
namespace content_a\website\quote\add;

class model
{

	public static function post()
	{

		$post =
		[
			'displayname' => \dash\request::post('displayname'),
			'job'         => \dash\request::post('job'),
			'text'        => \dash\request::post('text'),
			'star'        => \dash\request::post('star'),
		];

		if(\dash\request::files('image'))
		{
			$post['image'] = 'image';
		}

		if(!\dash\data::quoteID())
		{
			$quote = \lib\app\website\body\line\quote::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($quote['id']))
				{
					\dash\redirect::to(\dash\url::this(). '/quote?id='. $quote['id']);
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
			$quote = \lib\app\website\body\line\quote::edit($post, \dash\data::quoteID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/quote?id='. \dash\data::quoteID());
			}
		}
	}

}
?>
