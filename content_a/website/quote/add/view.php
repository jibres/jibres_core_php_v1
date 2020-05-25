<?php
namespace content_a\website\quote\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add quote page'));


		if(\dash\data::quoteID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/quote/setting?id='. \dash\data::quoteID());


			if(\dash\data::lineSetting_quote() && is_array(\dash\data::lineSetting_quote()))
			{
				// back
				\dash\data::back_text(T_('Slider list'));
				\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::quoteID());

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
			\dash\face::btnSetting(\dash\url::this(). '/quote/setting');
		}

		$ratio = \lib\app\website\body\line\quote::ratio(\dash\data::lineSetting());
		$ratioHtml = '';
		if(isset($ratio['ratio']))
		{
			$ratioHtml .= 'data-ratio="'. $ratio['ratio']. '" ';
		}

		if(isset($ratio['min_w']))
		{
			$ratioHtml .= 'data-min-w="'. $ratio['min_w']. '" ';
		}

		if(isset($ratio['min_h']))
		{
			$ratioHtml .= 'data-min-h="'. $ratio['min_h']. '" ';
		}

		if(isset($ratio['max_w']))
		{
			$ratioHtml .= 'data-max-w="'. $ratio['max_w']. '" ';
		}

		if(isset($ratio['max_h']))
		{
			$ratioHtml .= 'data-max-h="'. $ratio['max_h']. '" ';
		}

		\dash\data::ratioHtml($ratioHtml);


		if(\dash\data::lineSetting_quote() && is_array(\dash\data::lineSetting_quote()))
		{
			$quote = \dash\data::lineSetting_quote();
			foreach ($quote as $key => $value)
			{
				$quote[$key]['edit_link'] = \dash\url::this(). '/quote/edit?id='. \dash\data::quoteID(). '&index='. $key;
			}

			// $quote[] =
			// [
			// 	'image'  => \dash\url::icon(),
			// 	'edit_link'    => \dash\url::this(). '/quote/add?id='. \dash\data::quoteID(),
			// 	'alt'    => null,
			// 	'sort'   => null,
			// 	'target' => null,
			// 	'mod'    => 'add',
			// ];

			\dash\data::lineSetting_quote($quote);
		}
	}
}
?>
