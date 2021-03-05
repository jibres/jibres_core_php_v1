<?php
namespace dash\waf\gate;
/**
 * dash main configure
 */
class agent
{
	public static function inspection()
	{
		$agent = \dash\agent::agent(false);

		if($agent === null || $agent === '')
		{
			return null;
		}
		// only can be text
		\dash\waf\gate\toys\only::something($agent);
		\dash\waf\gate\toys\only::text($agent);

		// check len
		\dash\waf\gate\toys\general::len($agent, 1, 1000);

		// disallow html tags
		\dash\waf\gate\toys\block::tags($agent);
		// disallow some words
		\dash\waf\gate\toys\block::word($agent, 'script');
		\dash\waf\gate\toys\block::word($agent, 'javascript');
		\dash\waf\gate\toys\block::word($agent, 'prompt');
		\dash\waf\gate\toys\block::word($agent, 'delete');
		\dash\waf\gate\toys\block::word($agent, 'xss');
		\dash\waf\gate\toys\block::word($agent, '{');
		\dash\waf\gate\toys\block::word($agent, '}');
		\dash\waf\gate\toys\block::word($agent, '<');
		\dash\waf\gate\toys\block::word($agent, '>');
		\dash\waf\gate\toys\block::word($agent, '"');
		\dash\waf\gate\toys\block::word($agent, "'");
		\dash\waf\gate\toys\block::word($agent, "\n");
	}
}
?>
