<?php
namespace lib\app\form\comment;

class ready
{

	public static function row($_data)
	{
		$result = [];

		if(!$_data)
		{
			return $result;
		}

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'content':
					$result['content_raw'] = $value;

					if($value)
					{
						$value = \lib\shortcode::make_clickable($value);
						$value = \lib\shortcode::make_markdown($value);
					}
					$result[$key] = $value;
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