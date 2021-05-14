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


		\dash\face::title(T_("Comments"));


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