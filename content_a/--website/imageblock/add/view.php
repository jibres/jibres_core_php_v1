<?php
namespace content_a\website\imageblock\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add image'));


		if(\dash\data::imageblockID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/imageblock/setting?id='. \dash\data::imageblockID());


			if(\dash\data::lineSetting_imageblock() && is_array(\dash\data::lineSetting_imageblock()))
			{
				// back
				\dash\data::back_text(T_('Image list'));
				\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::imageblockID());

			}
			else
			{
				// back
				\dash\data::back_text(T_('Website body'));
				\dash\data::back_link(\dash\url::this(). '/body');
			}
		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '/body');
			\dash\face::btnSetting(\dash\url::this(). '/imageblock/setting');
		}

		\lib\ratio::data_ratio_html(\dash\data::lineSetting_ratio());



		if(\dash\data::lineSetting_imageblock() && is_array(\dash\data::lineSetting_imageblock()))
		{
			$imageblock = \dash\data::lineSetting_imageblock();
			foreach ($imageblock as $key => $value)
			{
				$imageblock[$key]['edit_link'] = \dash\url::this(). '/imageblock/edit?id='. \dash\data::imageblockID(). '&index='. $key;
			}

			// $imageblock[] =
			// [
			// 	'image'  => \dash\url::icon(),
			// 	'edit_link'    => \dash\url::this(). '/imageblock/add?id='. \dash\data::imageblockID(),
			// 	'alt'    => null,
			// 	'sort'   => null,
			// 	'target' => null,
			// 	'mod'    => 'add',
			// ];

			\dash\data::lineSetting_imageblock($imageblock);
		}
	}
}
?>
