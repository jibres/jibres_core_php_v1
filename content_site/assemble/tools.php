<?php
namespace content_site\assemble;


class tools
{

	public static function date($_date, $_type)
	{
		switch ($_type)
		{
			case 'date':
				return \dash\fit::date($_date, 'readable');
				break;

			case 'full':
				return \dash\fit::date_time($_date);
				break;

			case 'relative':
				return \dash\fit::date_human($_date);
				break;

			case 'no':
			default:
				return null;
				break;
		}
	}


	public static function section_id($_type, $_id)
	{
		return 'id="'.$_type. '-'. $_id.'"';
	}
}
?>