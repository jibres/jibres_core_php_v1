<?php
namespace content_a\website\imageblock\add;

class model
{

	public static function post()
	{

		$post =
		[
			'url'    => \dash\request::post('url'),
			'target' => \dash\request::post('target'),
			'alt'    => \dash\request::post('alt'),
			'sort'   => \dash\request::post('sort'),
		];

		if(\dash\request::files('image'))
		{
			$post['image'] = 'image';
		}

		if(!\dash\data::imageblockID())
		{
			$imageblock = \lib\app\website\body\line\imageblock::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($imageblock['id']))
				{
					\dash\redirect::to(\dash\url::this(). '/imageblock?id='. $imageblock['id']);
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
			$imageblock = \lib\app\website\body\line\imageblock::edit($post, \dash\data::imageblockID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/imageblock?id='. \dash\data::imageblockID());
			}
		}
	}

}
?>
