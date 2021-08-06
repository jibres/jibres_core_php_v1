<?php
namespace content_site\grid;


class analyze
{
	/**
	 * in this model, container is fixed max-w-screen-lg
	 * it means max width of container is 1024px
	 * if we devide it to 3 part,
	 *
	 *
	 * @param  [type] $_totalCount [description]
	 * @param  [type] $_totalExist [description]
	 * @param  [type] $_index      [description]
	 * @return [type]              [description]
	 */
	public static function className($_totalCount, $_totalExist, $_index)
	{
		$class   = '';
		$colSpan = '';
		$colStart = '';

		switch ($_totalExist)
		{
			case '1':
				$colSpan = 'col-span-12 sm:col-span-8 md:col-span-6 lg:col-span-4';
				$colStart   = 'col-start-1 sm:col-start-3 md:col-start-4 lg:col-start-5';
				break;

			case '2':
				if($_index === 0)
				{
					$colStart   = 'col-start-1 md:col-start-3';
				}
				$colSpan = 'col-span-12 sm:col-span-6 md:col-span-4';
				break;

			case '3':
				$colSpan = 'col-span-12 sm:col-span-6 md:col-span-4';
				if($_index === 2)
				{
					$colStart   = 'sm:col-start-4 md:col-start-auto';
				}
				break;

			case '4':
				$colSpan = 'col-span-12 sm:col-span-6 lg:col-span-3';
				break;

			default:

				break;
		}


		$class .= $colSpan. ' '. $colStart;

		return $class;
	}


	public static function get_class($_args)
	{
		$grid_cols = 'grid-cols-1 gap-4';
		switch (a($_args, 'container'))
		{
			case 'sm':
				// $grid_cols = 'grid-cols-1';
				break;

			case 'md':
				$grid_cols .= ' md:grid-cols-2';
				break;

			case 'lg':
			case 'auto':
				$grid_cols .= ' md:grid-cols-2 lg:grid-cols-3';
				break;

			case 'xl':
				$grid_cols .= ' md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-6';
				break;

			case '2xl':
			case 'none':
			default:
				$grid_cols .= ' md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-6 2xl:grid-cols-5 px-5';
				break;
		}

		return $grid_cols;
	}
}
?>