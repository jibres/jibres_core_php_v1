<?php
namespace lib\app\pos;


class add
{
	public static function new_pos($_args)
	{
		if(!\lib\store::id())
		{
			return false;
		}

		\dash\app::variable($_args);

		$pos = \dash\app::request('pos');

		if(!$pos)
		{
			\dash\notif::error(T_("Please choose your pos"), 'pos');
			return false;
		}

		$title = \dash\app::request('title');

		if($title && mb_strlen($title) > 100 )
		{
			\dash\notif::error(T_("Please set your title less than 100 character"), 'title');
			return false;
		}

		$allow_pos =
		[
			'saderat', 'mellat', 'tejarat', 'melli', 'sepah', 'keshavarzi',
			'parsian', 'maskan', 'refah', 'novin', 'ansar', 'pasargad',
			'saman', 'sina', 'post', 'ghavamin', 'taavon', 'shahr', 'ayande',
			'sarmayeh', 'day', 'hekmat', 'iranzamin', 'karafarin', 'gardeshgari',
			'madan', 'tsaderat', 'khavarmiyane', 'ivbb', 'irkish', 'asanpardakht',
			'zarinpal', 'payir',
		];

		if(!in_array($pos, $allow_pos))
		{
			\dash\notif::error(T_("Invalid pos"), 'pos');
			return false;
		}

		$old = \lib\app\pos\datalist::list();

		$default = false;
		if(count($old) === 0)
		{
			$default = true;
		}

		$pc_pos = null;
		if($pos === 'irkish')
		{
			// irankish setting get
			$pc_pos = \lib\app\pos\irankish::config();

			if(!$pc_pos || !is_array($pc_pos))
			{
				return false;
			}
		}

		if($pos === 'asanpardakht')
		{
			// asanpardakht setting get
			$pc_pos = \lib\app\pos\asanpardakht::config();

			if(!$pc_pos || !is_array($pc_pos))
			{
				return false;
			}
		}

		$new_pos =
		[
			'title'       => $title,
			'slug'        => $pos,
			'pcpos'       => $pc_pos ? 1 : null,
			'setting'     => json_encode($pc_pos, JSON_UNESCAPED_UNICODE),
			'isdefault'   => $default,
			'status'      => 'enable',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$pos_id = \lib\db\pos\insert::new_record($new_pos);

		if($pos_id)
		{
			\dash\notif::ok(T_("Pos setting saved"));
			return true;
		}
		else
		{
			\dash\log::set('dbCanNotAddPos');
		}

		return false;
	}

}
?>