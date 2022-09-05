<?php

namespace lib\app\form\form;


class check
{

	public static function variable($_args, $_id = null)
	{
		$condition =
			[
				'title'                   => 'title',
				'slug'                    => 'slug',
				'lang'                    => 'lang',
				'password'                => 'string_100',
				'privacy'                 => ['enum' => ['public', 'private']],
				'status'                  => [
					'enum' => [
						'draft', 'publish', 'expire', 'deleted', 'lock', 'awaiting', 'block', 'filter', 'close',
						'trash', 'full',
					],
				],
				'redirect'                => 'string_1000',
				'desc'                    => 'desc',
				'endmessage'              => 'desc',
				'beforestart'             => 'desc',
				'afterend'                => 'desc',
				'starttime'               => 'datetime',
				'endtime'                 => 'datetime',
				'file'                    => 'string_1000',
				'startdate'               => 'date',
				'enddate'                 => 'date',
				'stime'                   => 'time',
				'etime'                   => 'time',
				'inquiry_mode'            => 'bit',
				'inquiry'                 => 'bit',
				'inquirymsg'              => 'desc',
				'showcomment'             => 'bit',
				'schedule'                => 'bit',
				'showpulictag'            => 'bit',
				'question'                => 'array',
				'inquiryimage'            => 'string_1000',
				'inquiry_msg_founded'     => 'string_250',
				'inquiry_msg_not_founded' => 'string_250',
				'saveasticket'            => 'bit',

				'resultpage_mode' => 'bit',
				'resultpage'      => 'bit',
				'resultpagetext'  => 'desc',

			];

		$require = ['title', 'status'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if (!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title']);
		}

		if ($data['slug'])
		{
			$check_duplicate = \lib\db\form\get::by_slug($data['slug']);
			if (isset($check_duplicate['id']))
			{
				if (intval($check_duplicate['id']) === intval($_id))
				{
					// ok
				}
				else
				{
					if (is_null($_id))
					{
						$data['slug'] = $data['slug'] . rand(111, 999);
						// in add mode
					}
					else
					{
						\dash\notif::error(T_("Duplicate form slug. Try another name"));
						return false;
					}
				}
			}
		}

		$load_form = [];
		if ($_id)
		{
			$load_form = \lib\db\form\get::by_id($_id);
		}

		$setting = [];

		if (isset($load_form['setting']) && $load_form['setting'])
		{
			$setting = json_decode($load_form['setting'], true);
			if (!is_array($setting))
			{
				$setting = [];
			}
		}

		if (array_key_exists('saveasticket', $_args))
		{
			$setting['saveasticket'] = $data['saveasticket'];
		}

		if (array_key_exists('beforestart', $_args))
		{
			$setting['beforestart'] = $data['beforestart'];
		}

		if (array_key_exists('afterend', $_args))
		{
			$setting['afterend'] = $data['afterend'];
		}


		$data['setting'] = json_encode($setting, JSON_UNESCAPED_UNICODE);

		if ($data['inquiry_mode'])
		{
			$data['inquirysetting'] = [];

			$data['inquirysetting']['showcomment']  = $data['showcomment'];
			$data['inquirysetting']['showpulictag'] = $data['showpulictag'];

			$data['inquirysetting']['inquiry_msg_founded']     = $data['inquiry_msg_founded'];
			$data['inquirysetting']['inquiry_msg_not_founded'] = $data['inquiry_msg_not_founded'];

			if ($data['question'])
			{
				foreach ($data['question'] as $key => $value)
				{
					if (!\dash\validate::id($value))
					{
						return false;
					}
				}

				$data['inquirysetting']['question'] = $data['question'];
			}

			$data['inquirysetting'] = json_encode($data['inquirysetting'], JSON_UNESCAPED_UNICODE);
		}

		if ($data['resultpage_mode'])
		{
			$data['resultpagesetting'] = [];

//			$data['resultpagesetting']['showcomment']  = $data['showcomment'];
//			$data['resultpagesetting']['showpulictag'] = $data['showpulictag'];



			if ($data['question'])
			{
				foreach ($data['question'] as $key => $value)
				{
					if (!\dash\validate::id($value))
					{
						return false;
					}
				}

				$data['resultpagesetting']['question'] = $data['question'];
			}

			$data['resultpagesetting'] = json_encode($data['resultpagesetting'], JSON_UNESCAPED_UNICODE);
		}

		if ($data['startdate'])
		{
			$data['starttime'] = $data['startdate'];

			if ($data['stime'])
			{
				$data['starttime'] .= ' ' . $data['stime'];
			}
			else
			{
				$data['starttime'] .= ' 00:00:00';
			}
		}

		if ($data['enddate'])
		{
			$data['endtime'] = $data['enddate'];

			if ($data['stime'])
			{
				$data['endtime'] .= ' ' . $data['etime'];
			}
			else
			{
				$data['endtime'] .= ' 23:59:59';
			}
		}

		if ($data['starttime'] && $data['endtime'])
		{
			if (strtotime($data['starttime']) > strtotime($data['endtime']))
			{
				\dash\notif::error(T_("Start time must be less than end time"), [
					'element' => [
						'startdate', 'enddate', 'starttime', 'endtime',
					],
				]);
				return false;
			}
		}

		if (!$data['schedule'])
		{
			$data['starttime'] = null;
			$data['endtime']   = null;
		}

		unset($data['beforestart']);
		unset($data['afterend']);
		unset($data['schedule']);
		unset($data['startdate']);
		unset($data['enddate']);
		unset($data['stime']);
		unset($data['etime']);

		unset($data['saveasticket']);
		unset($data['showpulictag']);
		unset($data['showcomment']);
		unset($data['inquiry_mode']);
		unset($data['question']);
		unset($data['inquiry_msg_founded']);
		unset($data['inquiry_msg_not_founded']);

		unset($data['resultpage_mode']);
		unset($data['resultpage']);




		return $data;
	}

}

?>