<?php
namespace lib\app\irvat;


class ready
{
	public static function row($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = $value;
					break;

				case 'factordate':
					$result[$key] = $value;
					if($value)
					{

						if(\dash\language::current() === 'fa')
						{
							$result['factordate_raw'] = \dash\utility\convert::to_en_number(\dash\fit::date($value));
						}
						else
						{
							$result['factordate_raw'] = $value;
						}
					}
					break;


				default:
					$result[$key] = $value;
					break;
			}
		}
		return $result;
	}
}
?>