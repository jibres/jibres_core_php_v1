<?php
namespace dash\waf\gate;

/**
 * This class describes a file.
 */
class file
{
	public static function inspection()
	{
		$file = $_FILES;

		if(!$file)
		{
			return;
		}

		\dash\waf\gate\toys\only::array($file);

		\dash\waf\gate\toys\general::array_count($file, 1, 3);

		foreach ($file as $file_name => $file_detail)
		{
			\dash\waf\gate\toys\only::something($file_name);

			\dash\waf\gate\toys\only::text($file_name);

			\dash\waf\gate\toys\general::len($file_name, 3, 13); // a_1234567890 // for form generator


			if(isset($file_detail['name']))
			{
				\dash\waf\gate\toys\only::something($file_detail['name']);

				\dash\waf\gate\toys\only::text($file_detail['name']);

				\dash\waf\gate\toys\general::len($file_detail['name'], 1, 200);

				\dash\waf\gate\toys\block::tags($file_detail['name'], $file_name);

				\dash\waf\gate\toys\block::word($file_detail['name'], 'script');
				\dash\waf\gate\toys\block::word($file_detail['name'], 'javascript');
				\dash\waf\gate\toys\block::word($file_detail['name'], 'prompt');
				\dash\waf\gate\toys\block::word($file_detail['name'], 'delete');
				\dash\waf\gate\toys\block::word($file_detail['name'], 'xss');
				\dash\waf\gate\toys\block::word($file_detail['name'], '{');
				\dash\waf\gate\toys\block::word($file_detail['name'], '}');
				\dash\waf\gate\toys\block::word($file_detail['name'], "\n");

				\dash\waf\gate\toys\block::word($file_detail['name'], '"');
				\dash\waf\gate\toys\block::word($file_detail['name'], "'");
				\dash\waf\gate\toys\block::word($file_detail['name'], "/");
				\dash\waf\gate\toys\block::word($file_detail['name'], ":");
				\dash\waf\gate\toys\block::word($file_detail['name'], '<');
				\dash\waf\gate\toys\block::word($file_detail['name'], '>');
				\dash\waf\gate\toys\block::word($file_detail['name'], "?");
				\dash\waf\gate\toys\block::word($file_detail['name'], "*");
				\dash\waf\gate\toys\block::word($file_detail['name'], "|");
				\dash\waf\gate\toys\block::word($file_detail['name'], "\\");
			}


			if(isset($file_detail['type']))
			{
				\dash\waf\gate\toys\only::something($file_detail['type']);

				\dash\waf\gate\toys\only::text($file_detail['type']);

				\dash\waf\gate\toys\general::len($file_detail['type'], 1, 100); // for .docx type

				\dash\waf\gate\toys\block::tags($file_detail['type'], $file_name);

				\dash\waf\gate\toys\block::word($file_detail['type'], 'script');
				\dash\waf\gate\toys\block::word($file_detail['type'], 'svg');
				\dash\waf\gate\toys\block::word($file_detail['type'], 'javascript');
				\dash\waf\gate\toys\block::word($file_detail['type'], 'prompt');
				\dash\waf\gate\toys\block::word($file_detail['type'], 'delete');
				\dash\waf\gate\toys\block::word($file_detail['type'], 'xss');
				\dash\waf\gate\toys\block::word($file_detail['type'], '{');
				\dash\waf\gate\toys\block::word($file_detail['type'], '}');
				\dash\waf\gate\toys\block::word($file_detail['type'], "\n");

				\dash\waf\gate\toys\block::word($file_detail['type'], '"');
				\dash\waf\gate\toys\block::word($file_detail['type'], "'");
				\dash\waf\gate\toys\block::word($file_detail['type'], ":");
				\dash\waf\gate\toys\block::word($file_detail['type'], '<');
				\dash\waf\gate\toys\block::word($file_detail['type'], '>');
				\dash\waf\gate\toys\block::word($file_detail['type'], "?");
				\dash\waf\gate\toys\block::word($file_detail['type'], "*");
				\dash\waf\gate\toys\block::word($file_detail['type'], "|");
				\dash\waf\gate\toys\block::word($file_detail['type'], "\\");

				// $allow_type =
				// [
				// 	'application/zip',
				// 	'application/x-rar-compressed',
				// 	'audio/mpeg',
				// 	'audio/x-wav',
				// 	'audio/ogg',
				// 	'audio/x-ms-wma',
				// 	'audio/x-m4a',
				// 	'audio/aac',
				// 	'image/webp',
				// 	'image/gif',
				// 	'image/jpeg',
				// 	'image/jpeg',
				// 	'image/png',
				// 	'application/pdf',
				// 	'audio/ogg',
				// 	'video/webm',
				// 	'video/mpeg',
				// 	'video/mpeg',
				// 	'video/mp4',
				// 	'video/quicktime',
				// 	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				// 	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				// 	'application/vnd.openxmlformats-officedocument.presentationml.presentation',
				// 	'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
				// 	'text/plain',
				// 	'text/csv',
				// ];

				// \dash\waf\gate\toys\only::enum($file_detail['type'], $allow_type);
			}

			if(isset($file_detail['tmp_name']))
			{
				\dash\waf\gate\toys\only::something($file_detail['tmp_name']);

				\dash\waf\gate\toys\only::text($file_detail['tmp_name']);

				\dash\waf\gate\toys\general::len($file_detail['tmp_name'], 1, 100);

				$basename = basename($file_detail['tmp_name']);

				\dash\waf\gate\toys\only::something($basename);

				\dash\waf\gate\toys\only::text($basename);

			}
		}
	}
}
?>
