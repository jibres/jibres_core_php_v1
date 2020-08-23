<?php
namespace content_a\accounting\doc\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add accounting doc'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::accountingYear(\lib\app\tax\year\get::list());
		\dash\data::dataRow_number(\lib\app\tax\doc\get::new_doc_number());

		if(\dash\request::get('type') === 'opening')
		{
			\dash\data::openingMode(true);
			$default_year = \lib\app\tax\year\get::default_year('id');

			if($default_year)
			{
				$load_opening_doc = \lib\app\tax\doc\get::opening_doc($default_year);
				\dash\data::openingDoc($load_opening_doc);
			}
		}

	}
}
?>
