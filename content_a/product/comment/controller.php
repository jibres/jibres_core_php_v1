<?php
namespace content_a\product\comment;

class controller
{
	public static function routing()
	{
		\content_a\product\load::product();

		if(\dash\url::subchild() === 'remove' && \dash\request::get('commentid'))
		{
			\dash\open::get();
			\dash\open::post();
			\dash\data::removeMode(true);
		}

		if(\dash\request::get('commentid'))
		{
			if(!\dash\data::removeMode())
			{
				\dash\data::editMode(true);
			}
			$id      = \dash\request::get('commentid');
			$dataRow = \lib\app\product\comment::get($id);

			if(!$dataRow)
			{
				\dash\header::status(404, T_("Invalid product comment id"));
			}

			\dash\data::dataRow($dataRow);
		}
		else
		{
			$commentList = \lib\app\product\comment::of_product(\dash\request::get('id'), \dash\request::get('q'));

			\dash\data::dataTable($commentList);
		}


	}
}
?>