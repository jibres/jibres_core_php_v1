<?php
namespace dash\engine\dog;
/**
 * dash main configure
 */
class agent
{
	public static function inspection($_agent)
	{
		// only can be text
		\dash\engine\dog\toys\only::something($_agent);
		\dash\engine\dog\toys\only::text($_agent);

		// check len
		\dash\engine\dog\toys\general::len($_agent, 1, 1000);

		// disallow some words
		\dash\engine\dog\toys\block::word($_agent, 'script');
		\dash\engine\dog\toys\block::word($_agent, 'javascript');
		\dash\engine\dog\toys\block::word($_agent, 'delete');
		\dash\engine\dog\toys\block::word($_agent, '{');
		\dash\engine\dog\toys\block::word($_agent, '}');
		\dash\engine\dog\toys\block::word($_agent, '"');
		\dash\engine\dog\toys\block::word($_agent, "'");

	}
}
?>
