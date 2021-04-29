<?php
namespace content_a\pagebuilder\build;


class view
{
	public static function config()
	{

		$get       = \dash\request::get();
		$load_line = \lib\pagebuilder\tools\search::list($get);
		\dash\data::lineList($load_line);

		self::set_page_variable();

		if(!\dash\data::lineSetting())
		{
			\dash\data::action_text(T_('Add new line'));
			\dash\data::action_link(\dash\url::this(). '/additem'. \dash\request::full_get());
		}


	}



	/**
	 * set page variable
	 */
	private static function set_page_variable()
	{
		$lineSetting = \dash\data::lineSetting();

		\dash\face::title(T_('Build your page'));


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
				\dash\face::title(T_('Edit element title'));
			}

			if(isset($current_page_detail['btn_advance']))
			{
				\dash\face::btnSetting($current_page_detail['btn_advance']);
			}


			if(isset($current_page_detail['btn_preview']))
			{
				\dash\face::btnPreview($current_page_detail['btn_preview']);
			}


		}

		$back_args = [];

		if(isset($current_page_detail['back_args']))
		{
			$back_args = $current_page_detail['back_args'];
		}




		if($lineSetting)
		{
			$dir = \dash\url::dir();

			array_shift($dir);

			if($dir)
			{
				array_pop($dir);
			}

			$url = \dash\url::this();

			if(count($dir) === 1)
			{
				$back_args['pid'] = null;
			}

			if($dir)
			{
				$url .= '/'. implode('/', $dir);
			}

			$url .= \dash\request::full_get($back_args);


			\dash\data::back_text(T_('Back'));
			\dash\data::back_link($url);
		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());

			$lineList = \dash\data::lineList();

			if(isset($lineList['post_detail']['link']))
			{
				if(a($lineList, 'post_detail', 'status') === 'publish')
				{
					\dash\face::btnView($lineList['post_detail']['link']);
				}
				else
				{
					\dash\face::btnPreview($lineList['post_detail']['link']. '?preview=yes');
				}
			}

			if(a($lineList, 'post_detail', 'ishomepage'))
			{
				\dash\face::title(T_('Manage homepage'));
			}
		}
	}
}
?>