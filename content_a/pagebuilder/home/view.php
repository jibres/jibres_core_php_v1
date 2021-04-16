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



		if(!$lineSetting)
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
