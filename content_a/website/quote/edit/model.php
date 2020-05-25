<?php
namespace content_a\website\quote\edit;

class model extends \content_a\website\quote\add\model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'quote')
		{
			$quote = \lib\app\website\body\line\quote::remove(\dash\data::quoteID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/quote?id='. \dash\data::quoteID());
			}

			return;
		}

		parent::post();
	}
}
?>
