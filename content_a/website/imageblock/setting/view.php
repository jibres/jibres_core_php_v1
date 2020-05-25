<?php
namespace content_a\website\imageblock\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage image block'));

		if(\dash\data::imageblockID())
		{
			// back
			\dash\data::back_text(T_('Image list'));
			\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::imageblockID());
		}
		else
		{

			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '?id='. \dash\data::imageblockID());
		}

		\dash\data::defaultRatioSlider(\lib\app\website\body\line\imageblock::default_ratio('title'));

		\dash\data::imageblockNameSuggestion(\lib\app\website\body\line\imageblock::suggest_new_name());


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
