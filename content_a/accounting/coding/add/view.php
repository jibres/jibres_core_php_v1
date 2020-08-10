<?php
namespace content_a\accounting\coding\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add accounting coding'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$type = \dash\request::get('type');
		\dash\data::parentList(\lib\app\tax\coding\get::parent_list($type));


		self::static_var();

	}


	public static function static_var()
	{

		$dataTableAll = \lib\app\tax\coding\search::list_tree(['open_all' => true]);
		\dash\data::dataTableAll($dataTableAll);

		$otherList = [];
		switch (\dash\data::myType())
		{
			case 'group':
				$otherList = \lib\app\tax\coding\get::list_of('group');
				break;

			default:
				# code...
				break;
		}

		\dash\data::otherList($otherList);

	}
}
?>
