<?php
namespace content_love\gift\create\price;


class model
{
	public static function post()
	{

		$post =
		[
			'giftpercent' => \dash\request::post('giftpercent'),
			'giftmax'     => \dash\request::post('giftmax'),
			'giftamount'  => \dash\request::post('giftamount'),
			'pricefloor'  => \dash\request::post('pricefloor'),
		];

		if(\dash\request::get('id'))
		{
			\lib\app\gift\edit::edit($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/usage?id='. \dash\request::get('id'));
			}
		}
		else
		{
			$post['type'] = \dash\request::get('type');

			$create = \lib\app\gift\create::new_gift_card($post);

			if(isset($create['id']) && \dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/usage?id='. $create['id']);
			}
		}

	}
}
?>