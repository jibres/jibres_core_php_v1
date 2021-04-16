<?php
namespace content_a\pagebuilder\home;


class view
{
	public static function config()
	{


		self::set_page_variable();


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
	 * set page variable
	 */
	private static function set_page_variable()
	{
		$lineSetting = \dash\data::lineSetting();

		$subchild = \dash\url::subchild();

		$dir_3 = \dash\url::dir(3);

		\dash\face::title(T_('Build Your Unique Online Website'));

		if(a($lineSetting, 'page_title'))
		{
			\dash\face::title(a($lineSetting, 'page_title'));
		}

		$elements = a($lineSetting, 'elements');

		if($subchild)
		{
			if(a($elements, $subchild, 'detail', 'page_title'))
			{
				\dash\face::title(a($elements, $subchild, 'detail', 'page_title'));
			}
		}


		if($subchild !== 'advance')
		{
			if(a($elements, 'advance'))
			{
				\dash\face::btnSetting(\dash\url::current(). '/advance'. \dash\request::full_get());
			}
		}



		if($subchild)
		{
			if(a($elements, $subchild, 'detail', 'btn_save'))
			{
				if(a($elements, $subchild, 'detail', 'btn_save') === true)
				{
					\dash\face::btnSave('form1');
				}
				else
				{
					\dash\face::btnSave(a($elements, $subchild, 'detail', 'btn_save'));
				}
			}
		}

		if($subchild === 'title' || $dir_3 === 'title')
		{
			\dash\face::btnSave('form1');
		}



		if(!$lineSetting)
		{
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::here());
		}
		else
		{
			if($dir_3)
			{
				$dir_2 = \dash\url::dir(2);

				$back = \dash\url::that(). '/'. $dir_2. \dash\request::full_get();
			}
			elseif($subchild)
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
