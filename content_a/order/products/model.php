<?php
namespace content_a\order\products;


class model
{
	public static function post()
	{
		$user    = \dash\request::get('user');
		$guestid = \dash\request::get('guestid');
		$product = \dash\request::post('product_id');
		$count   = \dash\request::post('count');
		$type    = \dash\request::post('type');


		if(\dash\request::post('assing') === 'assing')
		{

			$post                = [];
			$post['customer']    = \dash\request::post('customer');
			$post['mobile']      = \dash\request::post('memberTl');
			$post['gender']      = \dash\request::post('memberGender') ? \dash\request::post('memberGender') : null;
			$post['displayname'] = \dash\request::post('memberN');

			$user = \lib\app\cart\check::cart_user($post);


			if(isset($user['customer']))
			{

				$id = $user['customer'];

				$code = \dash\coding::encode($id);

				\lib\app\cart\add::assing_to_user($guestid, $code);

				if(\dash\engine\process::status())
				{
					\dash\redirect::to(\dash\url::that(). '?user='. $code);
				}

				return;
			}
			else
			{
				return false;
			}
		}

		if(\dash\request::post('removeall') === 'removeall')
		{
			\lib\app\cart\remove::remove_all($user, $guestid);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
		}

		if($type === 'edit_count' || $type === 'plus_count' || $type === 'minus_count')
		{
			\lib\app\cart\edit::edit($product, $count, $user, $guestid, $type);
		}
		elseif(\dash\request::post('type') === 'remove')
		{
			\lib\app\cart\remove::remove($product, $user, $guestid);
		}
		else
		{
			\lib\app\cart\add::add($product, $count, $user, $guestid);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
