<?php
namespace lib\app\plugin;


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