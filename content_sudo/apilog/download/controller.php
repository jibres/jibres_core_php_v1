<?php
namespace content_sudo\apilog\download;


class controller
{
	public static function routing()
	{
		$addr = __DIR__. '/myRecord.me.json';

		$load = \dash\db\apilog::get(\dash\request::get('id'));
		foreach ($load as $key => $value)
		{
			if(is_string($value) && in_array(substr($value, 0, 1), ['{', '[']))
			{
				$load[$key. '_array'] = json_decode($value, true);
			}
		}

		\dash\file::write($addr, json_encode($load, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		\dash\file::download($addr);
		\dash\code::bye();

	}
}
?>