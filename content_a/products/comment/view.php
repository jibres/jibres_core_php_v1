<?php
namespace content_a\products\comment;


class view
{
	public static function config()
	{

		// set page title from product title
		$title = \dash\data::productDataRow_title();
		if(!isset($title))
		{
			$title = T_("Without name");
		}

		\dash\face::title(T_("Comments"). ' | '. $title);

		$id = \dash\request::get('id');

		if($id)
		{
			// back
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);

		}
		else
		{
			// back
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

		$search_string            = \dash\request::get('q');

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
			'status' => \dash\request::get('status'),
			'product_id' => $id,
		];

		$dataTable = \lib\app\product\comment::list($search_string, $args);

		\dash\data::dataTable($dataTable);


		\dash\data::filterBox(\lib\app\product\comment::filter_message());

		$isFiltered = \lib\app\product\comment::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}
	}
}
?>