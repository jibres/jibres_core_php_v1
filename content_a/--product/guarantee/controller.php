<?php
namespace content_a\product\guarantee;

class controller
{
	public static function routing()
	{
		if(\dash\url::subchild() === 'remove' && \dash\request::get('id'))
		{
			\dash\open::get();
			\dash\open::post();
			\dash\data::removeMode(true);
		}

		if(\dash\request::get('id'))
		{
			if(!\dash\data::removeMode())
			{
				\dash\data::editMode(true);
			}
			$id      = \dash\request::get('id');
			$dataRow = \lib\app\product\guarantee::get($id);

			if(!$dataRow)
			{
				\dash\header::status(404, T_("Invalid product guarantee id"));
			}

			\dash\data::dataRow($dataRow);
		}
		else
		{
			$guaranteeList = \lib\app\product\guarantee::page_list(\dash\request::get('q'));
			\dash\data::dataTable($guaranteeList);
		}


	}
}
?>