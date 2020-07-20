<?php
namespace content_a\website\specialslider\edit;

class model extends \content_a\website\specialslider\add\model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'specialslider')
		{
			$specialslider = \lib\app\website\body\line\specialslider::remove(\dash\data::specialsliderID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/specialslider?id='. \dash\data::specialsliderID());
			}

			return;
		}

		parent::post();
	}
}
?>
