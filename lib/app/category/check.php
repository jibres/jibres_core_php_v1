<?php
namespace lib\app\category;


class check
{

	public static function variable($_id = null)
	{
		$title = \dash\app::request('title');
		if(!is_string($title))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

		if(!$title && $title !== '0')
		{
			\dash\notif::error(T_("Plese fill the category name"), 'category');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Category name is too large!"), 'category');
			return false;
		}

		$desc = \dash\app::request('desc');
		if(\dash\app::isset_request('desc') && !is_string($desc))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

		if(mb_strlen($desc) > 10000)
		{
			\dash\notif::error(T_("Category description is too large!"), 'category');
			return false;
		}

		$file = \dash\app::request('file');


		$slug = \dash\app::request('slug');
		if(\dash\app::isset_request('slug') && !is_string($slug))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

		if(\dash\app::isset_request('slug') && !$slug && $slug !== '0')
		{
			\dash\notif::error(T_("Plese fill the category slug"), 'category');
			return false;
		}

		if(mb_strlen($slug) > 100)
		{
			\dash\notif::error(T_("Category slug is too large!"), 'category');
			return false;
		}

		$parent1 = null;
		$parent2 = null;
		$parent3 = null;
		$parent4 = null;

		$parent = \dash\app::request('parent');
		if($parent)
		{
			if(!is_numeric($parent))
			{
				\dash\notif::error(T_("Invalid parent"), 'parent');
				return false;
			}

			$load_parent = \lib\app\category\get::inline_get($parent);
			if(!$load_parent)
			{
				\dash\notif::error(T_("Parent not found"), 'parent');
				return false;
			}


			if($_id && is_numeric($_id))
			{
				$have_child = \lib\db\productcategory\get::have_child($_id);
				if($have_child)
				{
					\dash\notif::error(T_("This category have some child and you can not change parent of it"), 'parent');
					return false;
				}
			}

			if(isset($load_parent['parent1']))
			{
				$parent1 = $load_parent['parent1'];

				if(isset($load_parent['parent2']))
				{
					$parent2 = $load_parent['parent2'];

					if(isset($load_parent['parent3']))
					{
						\dash\notif::error(T_("Can not choose this category as parent of another category"), 'parent');
						return false;
					}
					else
					{
						$parent3 = $parent;
					}
				}
				else
				{
					$parent2 = $parent;
				}
			}
			else
			{
				$parent1 = $parent;
			}
		}

		$args            = [];
		$args['title']   = $title;
		$args['desc']    = $desc;
		$args['slug']    = $slug;
		$args['file']    = $file;
		$args['parent1'] = $parent1;
		$args['parent2'] = $parent2;
		$args['parent3'] = $parent3;
		$args['parent4'] = $parent4;

		return $args;

	}

}
?>