<?php
namespace content_a\accounting\year\manage;

class model
{
	public static function post()
	{
		if(\dash\request::post('closeharmfullprofit') === 'closeharmfullprofit')
		{
			\lib\app\tax\doc\closing::close_harmful_profit(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd(\dash\url::that());
			}
			return;
		}

		if(\dash\request::post('accumulated') === 'accumulated')
		{
			\lib\app\tax\doc\closing::close_accumulated(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd(\dash\url::that());
			}
			return;
		}


		if(\dash\request::post('closing') === 'closing')
		{
			\lib\app\tax\doc\closing::closing(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd(\dash\url::that());
			}
			return;
		}





		$post =
		[
			'title'     => \dash\request::post('title'),
		];

		$result = \lib\app\tax\year\edit::edit($post, \dash\request::get('id'));


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
