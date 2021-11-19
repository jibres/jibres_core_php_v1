<?php
namespace content_a\setting\instagram;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Instagram'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social');


		$instagram_user_id = \lib\app\instagram\get::user_id();
		\dash\data::instagramUserId($instagram_user_id);


		$instagram_access_token = \lib\app\instagram\get::access_token();
		\dash\data::instagramAccessToken($instagram_access_token);

		// $instagram_access_token = 'IGQVJVUVc1Ym91SndnX0tOSGZA4U3NNanE2NkY4OWIwQXpVTFU3RXVoMGFjQUcxd0J4cXJyS0FJazhNSWtrdi1mdmlKZAXYtRm9oRmRWVFpqZAjRuc2FiUkZAzUE9vVzg4dHpCRlhSVHROeTRVYXJzSEU4UG5Ncmxvd2J4dlRV';
		// $instagram_user_id = '17841401959306742';
		if($instagram_access_token && $instagram_user_id)
		{
			$media = \lib\api\instagram\api::getUserMedia($instagram_access_token, $instagram_user_id);
			var_dump($media);
			var_dump($instagram_access_token);exit;
		}
	}
}
?>