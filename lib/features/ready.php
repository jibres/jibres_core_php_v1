<?php
namespace lib\features;


class ready
{
	public static function row($_data)
	{
		$result = [];

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}
}
?>