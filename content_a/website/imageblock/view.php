<?php
namespace content_a\website\imageblock;


class view
{
	public static function config()
	{
		if(\dash\data::lineSetting_title() && !\dash\detect\device::detectPWA())
		{
			\dash\face::title(\dash\data::lineSetting_title());
		}
		else
		{
			\dash\face::title(T_('Slider'));
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


		if(\dash\data::imageblockID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/imageblock/setting?id='. \dash\data::imageblockID());
			// action
			\dash\data::action_text(T_('Add imageblock'));
			\dash\data::action_link(\dash\url::this(). '/imageblock/add?id='. \dash\data::imageblockID());
		}


		if(\dash\data::lineSetting_imageblock() && is_array(\dash\data::lineSetting_imageblock()))
		{
			$imageblock = \dash\data::lineSetting_imageblock();
			foreach ($imageblock as $key => $value)
			{
				$imageblock[$key]['edit_link'] = \dash\url::this(). '/imageblock/edit?id='. \dash\data::imageblockID(). '&index='. $key;
			}

			\dash\data::lineSetting_imageblock($imageblock);
		}
		else
		{
			\dash\redirect::to(\dash\url::this(). '/imageblock/add?id='. \dash\data::imageblockID());
		}
	}
}
?>
