<?php
namespace lib\app\tax\year;


class check
{

	public static function variable($_args)
	{
		$condition =
		[
			'startdate' => 'date',
			'enddate'   => 'date',
			'title'     => 'string_300',
			'status'    => ['enum' => ['lock','enable']],
		];

		$require = ['title', 'startdate', 'enddate'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['startdate'] && $data['enddate'])
		{
			$startdate = \lib\app\tax\year\get::startdate();
			if($startdate)
			{
				$data['startdate'] = $startdate;
			}

			try
			{

				$datetime1 = new \DateTime($data['startdate']);
				$datetime2 = new \DateTime($data['enddate']);

				if($datetime1 >= $datetime2)
				{
					\dash\notif::error(T_("Invalid start date, start date can not larger than end date!"), ['element' => ['startdate', 'enddate']]);
					return false;
				}

				$diff = $datetime1->diff($datetime2);

				if(isset($diff->days))
				{
					if(floatval($diff->days) === floatval(365) || floatval($diff->days) === floatval(366))
					{
						// ok
					}
					else
					{
						\dash\notif::error(T_("Accounting year must exactly one year"), ['element' => ['startdate', 'enddate']]);
						return false;
					}
				}
				else
				{
					\dash\notif::error(T_("Invalid date"), ['element' => ['startdate', 'enddate']]);
					return false;
				}
			}
			catch(\Exception $e)
			{

				\dash\notif::error(T_("Invalid date"), ['element' => ['startdate', 'enddate']]);
				return false;
			}
		}

		return $data;

	}

}
?>