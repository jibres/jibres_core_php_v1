<?php
namespace dash\engine\dog;
/**
 * dash main configure
 */
class agent
{
	public static function inspection()
	{
		$agent = \dash\agent::agent(false);

		// only can be text
		\dash\engine\dog\toys\only::something($agent);
		\dash\engine\dog\toys\only::text($agent);

		// check len
		\dash\engine\dog\toys\general::len($agent, 1, 1000);

		// disallow html tags
		\dash\engine\dog\toys\block::tags($agent);
		// disallow some words
		\dash\engine\dog\toys\block::word($agent, 'script');
		\dash\engine\dog\toys\block::word($agent, 'javascript');
		\dash\engine\dog\toys\block::word($agent, 'prompt');
		\dash\engine\dog\toys\block::word($agent, 'delete');
		\dash\engine\dog\toys\block::word($agent, 'xss');
		\dash\engine\dog\toys\block::word($agent, '{');
		\dash\engine\dog\toys\block::word($agent, '}');
		\dash\engine\dog\toys\block::word($agent, '<');
		\dash\engine\dog\toys\block::word($agent, '>');
		\dash\engine\dog\toys\block::word($agent, '"');
		\dash\engine\dog\toys\block::word($agent, "'");
		\dash\engine\dog\toys\block::word($agent, "\n");
	}
}
?>
