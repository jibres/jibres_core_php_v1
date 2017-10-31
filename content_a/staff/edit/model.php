<?php
namespace content_a\staff\edit;
use \lib\utility;
use \lib\debug;

class model extends \content_a\main\model
{
	use model\contact;
	use model\identification;
	use model\avatar;
	use model\address;

	/**
	 * Gets the post staff.
	 *
	 * @return     array  The post staff.
	 */
	public function getPoststaff()
	{
		$post =
		[
			'firstname'      => utility::post('name'),
			'lastname'       => utility::post('lastName'),
			'nationalcode'   => utility::post('nationalcode'),
			'father'         => utility::post('father'),
			'birthday'       => utility::post('birthday'),
			'gender'         => utility::post('gender') === 'on' ? 'female' : 'male',
			'grade'          => utility::post('grade'),
		];

		return $post;
	}




	/**
	 * ready to edit member
	 * load data
	 *
	 * @param      <type>  $_team    The team
	 * @param      <type>  $_member  The member
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function loadStaffData($_args)
	{
		$id               = isset($_args->match->url[0][1]) ? $_args->match->url[0][1] : null;
		$request          = [];
		$request['id']    = $id;
		utility::set_request_array($request);
		$result           =  $this->get_staff();
		$parent           = $this->get_list_parent();

		$parent_list = [];
		if(is_array($parent))
		{
			foreach ($parent as $key => $value)
			{
				if(isset($value['title']) && isset($value['mobile']))
				{
					$parent_list[$value['title']] = $value['mobile'];
				}
			}
		}

		$result['parent'] = $parent_list;

		return $result;
	}


	/**
	 * Posts an addmember.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_staff_edit($_args)
	{

		$request       = $this->getPoststaff();
		$id            = isset($_args->match->url[0][1]) ? $_args->match->url[0][1] : null;

		if(!$request['firstname'] && !$request['lastname'])
		{
			debug::error(T_("Fill name or family is require!"));
			return false;
		}

		$request['id'] = $id;

		utility::set_request_array($request);

		// API ADD MEMBER FUNCTION
		$result = $this->add_staff(['method' => 'patch']);
	}

}
?>