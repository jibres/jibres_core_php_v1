<?php
namespace dash;

class browser
{
	public static function analyze($_agent = null)
	{
		$browser = get_browser($_agent, true);

		$result =
		[
			'agent'          => $_agent,
			'agentmd5'       => md5($_agent),
			'platform'       => isset($browser['platform'])       ? $browser['platform'] : null,
			'browser'        => isset($browser['browser'])        ? $browser['browser'] : null,
			'version'        => isset($browser['version'])        ? $browser['version'] : null,
			'device_type'    => isset($browser['device_type'])    ? $browser['device_type'] : null,
			'ismobiledevice' => isset($browser['ismobiledevice']) ? $browser['ismobiledevice'] : null,
			'istablet'       => isset($browser['istablet'])       ? $browser['istablet'] : null,
			'crawler'        => isset($browser['crawler'])        ? $browser['crawler'] : null,
		];

		return $result;
	}
}
?>