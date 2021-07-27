<?php
namespace content_a\accounting\report\quarter;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');

		if(\dash\request::get('fid'))
		{
			$fid = \dash\validate::id(\dash\request::get('fid'));
			if($fid)
			{
				\dash\data::oneFactorId($fid);
			}
		}

	}
}
?>
