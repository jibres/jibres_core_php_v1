<?php
namespace lib\app\discount;


class ready
{

	public static function row($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'status':
					$result[$key] = $value;
					if($value)
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