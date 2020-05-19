<?php
namespace content_a\website\slider\edit;

class model extends \content_a\website\slider\add\model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'slider')
		{
			$slider = \lib\app\website\body\line\slider::remove(\dash\data::sliderID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/slider?id='. \dash\data::sliderID());
			}

			return;
		}

		parent::post();
	}
}
?>
