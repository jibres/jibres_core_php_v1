<?php
namespace lib\db\productcomment;


class update
{


	public static function update()
	{
		return \dash\db\config::public_update('productcomment', ...func_get_args());
	}

}
?>
