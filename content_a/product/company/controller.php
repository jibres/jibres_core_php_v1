<?php
namespace content_a\product\company;

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
			$dataRow = \lib\app\product\company::get($id);

			if(!$dataRow)
			{
				\dash\header::status(404, T_("Invalid product company id"));
			}

			\dash\data::dataRow($dataRow);
		}
		else
		{
			$companyList = \lib\app\product\company::list();
			\dash\data::dataTable($companyList);
		}


	}
}
?>