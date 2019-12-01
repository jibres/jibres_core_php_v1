<?php
namespace content_su\install;

class controller
{
	public static function routing()
	{
		// run if get is set and no database exist

		if(\dash\file::read(root.'install.jibres') === 'Jibres')
		{
			require_once(core."engine/install.php");
			// this code exit the code
			\dash\code::end();
		}
		else
		{
			\dash\header::status(423);
		}
	}
}
?>