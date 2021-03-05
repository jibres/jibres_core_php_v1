<?php
namespace dash\waf\dog;
/**
 * dash main configure
 */
class agent
{
	public static function inspection()
	{
		$agent = \dash\agent::agent(false);

		// only can be text
		\dash\waf\dog\toys\only::something($agent);
		\dash\waf\dog\toys\only::text($agent);

		// check len
		\dash\waf\dog\toys\general::len($agent, 1, 1000);

		// disallow html tags
		\dash\waf\dog\toys\block::tags($agent);
		// disallow some words
		\dash\waf\dog\toys\block::word($agent, 'script');
		\dash\waf\dog\toys\block::word($agent, 'javascript');
		\dash\waf\dog\toys\block::word($agent, 'prompt');
		\dash\waf\dog\toys\block::word($agent, 'delete');
		\dash\waf\dog\toys\block::word($agent, 'xss');
		\dash\waf\dog\toys\block::word($agent, '{');
		\dash\waf\dog\toys\block::word($agent, '}');
		\dash\waf\dog\toys\block::word($agent, '<');
		\dash\waf\dog\toys\block::word($agent, '>');
		\dash\waf\dog\toys\block::word($agent, '"');
		\dash\waf\dog\toys\block::word($agent, "'");
		\dash\waf\dog\toys\block::word($agent, "\n");
	}
}
?>
