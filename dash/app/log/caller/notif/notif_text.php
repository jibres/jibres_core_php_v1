<?php
namespace dash\app\log\caller\notif;


class notif_text
{
	public static function site($_args = [])
	{

		$result              = [];

		$result["title"]     = isset($_args['data']['notif_title']) ? $_args['data']['notif_title'] : null;
		$result["text"]      = isset($_args['data']['notif_text']) ? $_args['data']['notif_text'] : null;
		$result["group"]     = isset($_args['data']['notif_group']) ? $_args['data']['notif_group'] : null;

		$result['cat']       = $result['group'];
		$result['iconClass'] = 'fc-blue';
		$result['txt']       = $result['text'];

		return $result;

	}

	public static function expire()
	{
		return date("Y-m-d H:i:s", strtotime("+365 days")); // 1 year
	}

	public static function is_notif()
	{
		return true;
	}

}
?>