<?php
namespace content_a\website\body\slider;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage slider'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


		if(\dash\data::sliderID())
		{
			\dash\face::btnView(\dash\url::that(). '/slider/set?id='. \dash\data::sliderID());
			// action
			\dash\data::action_text(T_('Add slider'));
			\dash\data::action_link(\dash\url::that(). '/slider/add?id='. \dash\data::sliderID());
		}

	}
}
?>
