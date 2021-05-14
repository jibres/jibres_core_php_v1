<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class post
{

	public static function post_track_id($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\number::number($_data, $_notif, $_element, $_field_title, ['min' => 100000000000000000000000, 'max' => 999999999999999999999999]);

		if($data === false || $data === null)
		{
			return $data;
		}

		return $data;
	}



}
?>