<?php
namespace lib\app\form\answer;


class ready
{

	public static function row($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'item_type':
					$result[$key] = $value;
					if($value === 'province_city')
					{
						if(isset($_data['answer']) && $_data['answer'] && is_string($_data['answer']))
						{
							$province           = substr($_data['answer'], 0, 5);
							$city               = substr($_data['answer'], 6);
							$result['province'] = $province;
							$result['city']     = $city;

							if($province)
							{
								$result['province_name'] = \dash\utility\location\provinces::get_localname($province);
							}

							if($city)
							{
								$result['city_name'] = \dash\utility\location\cites::get_localname($city);
							}

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