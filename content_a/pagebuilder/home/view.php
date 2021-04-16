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

		\dash\face::title(T_('Build Your Unique Online Website'));
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		if(isset($lineSetting['current_page_detail']))
		{
			$current_page_detail = [];
			$current_page = $lineSetting['current_page_detail'];

			if(isset($current_page['detail']))
			{
				$current_page_detail = $current_page['detail'];
			}


			if(isset($current_page_detail['page_title']))
			{
				\dash\face::title($current_page_detail['page_title']);
			}

			if(isset($current_page_detail['btn_add']))
			{
				$btn_add = $current_page_detail['btn_add'];

				if(a($btn_add, 'text') && a($btn_add, 'link') && \dash\url::pwd() !== a($btn_add, 'link'))
				{
					\dash\data::action_text(a($btn_add, 'text'));
					\dash\data::action_link(a($btn_add, 'link'));
				}
			}

			if(isset($current_page_detail['btn_save']))
			{
				if($current_page_detail['btn_save'] === true)
				{
					\dash\face::btnSave('form1');
				}
				else
				{
					\dash\face::btnSave($current_page_detail['btn_save']);
				}
			}

			if(isset($current_page['current_page']) && $current_page['current_page'] === 'title')
			{
				\dash\face::btnSave('form1');
			}

			if(isset($current_page_detail['btn_advance']))
			{
				\dash\face::btnSetting($current_page_detail['btn_advance']);
			}

		}




		if($lineSetting)
		{
			if(\dash\url::dir(3))
			{
				$dir_2 = \dash\url::dir(2);

				$back = \dash\url::that(). '/'. $dir_2. \dash\request::full_get();
			}
			elseif(\dash\url::subchild())
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
