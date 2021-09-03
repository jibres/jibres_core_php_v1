<?php
namespace content_a\website\imageblock\edit;

class model extends \content_a\website\imageblock\add\model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'imageblock')
		{
			$imageblock = \lib\app\website\body\line\imageblock::remove(\dash\data::imageblockID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/imageblock?id='. \dash\data::imageblockID());
			}

			return;
		}

		parent::post();
	}
}
?>
