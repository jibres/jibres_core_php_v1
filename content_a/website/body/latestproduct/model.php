<?php
namespace content_a\website\body\latestproduct;

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


		if(!\dash\data::latestproductID())
		{
			$latestproduct = \lib\app\website\body\line\latestproduct::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($latestproduct['id']))
				{
					\dash\redirect::to(\dash\url::that(). '/latestproduct?id='. $latestproduct['id']);
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
			$latestproduct = \lib\app\website\body\line\latestproduct::edit($post, \dash\data::latestproductID());

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/latestproduct?id='. \dash\data::latestproductID());
			}
		}
	}
}
?>
