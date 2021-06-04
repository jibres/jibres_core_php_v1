<?php
namespace dash\setting;


class whisper
{
	public static function say($_service, $_key = null)
	{
		$filePath = __DIR__. '/secret/'. $_service. '.secret.json';
		if(file_exists($filePath))
		{
			// read file
			$secretData = \dash\file::read($filePath);

			// check it's string
			if($secretData && is_string($secretData))
			{
				// decode it
				$secretData = json_decode($secretData, true);
				// check it's array
				if(is_array($secretData))
				{
					if($_key === null)
					{
						return $secretData;
					}
					else if($_key)
					{
						if(array_key_exists($_key, $secretData))
						{
							return $secretData[$_key];
						}
					}

				}
			}
		}

		return null;
	}
}
?>