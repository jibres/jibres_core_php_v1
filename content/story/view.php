<?php
namespace content\story;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Story'));
		\dash\face::desc(T_('Read about the tortuous journey of Jibers. To be continued...'));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/story/jibres-story-love.gif');

	}
}
?>