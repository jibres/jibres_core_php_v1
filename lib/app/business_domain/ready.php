<?php
namespace lib\app\business_domain;


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
				case 'status':
					$result[$key] = $value;

					if($value === 'ok')
					{
						$result['tstatus'] = T_("Connected");
					}
					else
					{
						$result['tstatus'] = T_(ucfirst($value));
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