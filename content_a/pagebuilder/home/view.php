<?php
namespace content_a\pagebuilder\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Build Your Unique Online Website'));

		// generate back link
		self::generate_back_link();

		// show btn sve
		if(\dash\data::lineSetting_btnSave())
		{
			\dash\face::btnSave(\dash\data::lineSetting_btnSave());
		}

		if(!\dash\data::lineSetting())
		{
			\dash\data::action_text(T_('Add new line'));
			\dash\data::action_link(\dash\url::this(). '/add');
		}

		$get       = \dash\request::get();
		$load_line = \lib\app\pagebuilder\line\search::list($get);
		\dash\data::lineList($load_line);

	}



	/**
	 * Generate back link
	 */
	private static function generate_back_link()
	{
		if(!\dash\data::lineSetting())
		{
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::here());
		}
		else
		{
			if(\dash\url::subchild())
			{
				$back = \dash\url::that(). \dash\request::full_get();
			}
			elseif(\dash\url::child())
			{
				$back = \dash\url::this();
			}
			else
			{
				$back = \dash\url::this();

			}

			\dash\data::back_text(T_('Back'));
			\dash\data::back_link($back);
		}
	}
}
?>
