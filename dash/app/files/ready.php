<?php
namespace dash\app\files;


class ready
{
	public static function row($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'creator':
					if($value)
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'type':
				case 'mime':
				case 'ext':
				case 'folder':
					$result[$key] = $value;
					break;

				case 'path':
					$result[$key] = \lib\filepath::fix($value);
					break;

				case 'size':
					$result[$key] = $value;
					break;


				default:
					$result[$key] = $value;
					break;
			}
		}

		if(isset($result['type']))
		{
			switch ($result['type'])
			{
				case 'image':
					$result['thumb'] = a($result, 'path');
					break;

				case 'archive':
				case 'audio':
				case 'pdf':
				case 'video':
				case 'word':
				case 'excel':
				case 'powerpoint':
				case 'code':
				case 'text':
				case 'file':
				default:
					$result['thumb'] = \dash\app::static_image_url();
					break;
			}
		}


		return $result;

	}
}
?>