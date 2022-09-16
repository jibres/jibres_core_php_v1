<?php

namespace lib\app\sms;


class dashboard
{
    public static function get()
    {
		$result = [];
		$result['countall'] = \lib\db\sms\get::count_all();

		// var_dump($result);exit();
		return $result;
    }
}
