<?php
namespace content_a\products\comment;


class view extends \content_cms\comments\home\view
{
	public static function config($_args = [])
	{

		$id            = \dash\request::get('id');

		$search_string = \dash\request::get('q');

		$args =
		[
			'product_id' => $id,
			'for'        => 'product',
		];

		parent::config($args);


		// set page title from product title
		$title = \dash\data::productDataRow_title();
		if(!isset($title))
		{
			$title = T_("Without name");
		}

		\dash\face::title(T_("Comments"). ' | '. $title);


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

	}
}
?>