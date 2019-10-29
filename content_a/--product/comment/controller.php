<?php
namespace content_a\product\comment;

class controller
{
	public static function routing()
	{
		\content_a\product\load::product();


		if(\dash\request::get('commentid'))
		{

			\dash\data::editMode(true);

			$id      = \dash\request::get('commentid');
			$commentDataRow = \lib\app\product\comment::get($id);

			if(!$commentDataRow)
			{
				\dash\header::status(404, T_("Invalid product comment id"));
			}

			\dash\data::commentDataRow($commentDataRow);
		}
		else
		{
			$commentList = \lib\app\product\comment::of_product(\dash\request::get('id'), \dash\request::get('q'));

			\dash\data::dataTable($commentList);
		}


	}
}
?>