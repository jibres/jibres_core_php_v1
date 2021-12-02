<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class socialnetwork
{

	public static function get_from_url($_url)
	{

		if(!$_url)
		{
			return false;
		}


		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 90);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);

		curl_close ($ch);

		if($response)
		{
			$new_path = tempnam(sys_get_temp_dir(), 'JIBRES_');
			\dash\file::write($new_path, $response);

			$meta =
			[
				'allow_size'       => \dash\upload\size::get(),
				'upload_from_path' => $new_path,
				'upload_name'      => 'social',
				'ext'              =>
				[
					'jpeg','jpg','png',			// image
				],
			];

			$file_detail = \dash\upload\file::upload(null, $meta);

			if(!$file_detail)
			{
				return false;
			}

			return $file_detail;
		}



	}

}
?>