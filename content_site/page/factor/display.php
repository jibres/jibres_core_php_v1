<?php

$page_factor = \dash\data::pageFactor();
if(!is_array($page_factor))
{
	$page_factor = [];
}

?>

<div class="btn-primary"><?php echo \dash\fit::number(\dash\data::myBudget_budget()); ?> <small><?php echo \dash\data::myBudget_currency() ?></small></div>

<div class='flex flex-col'>
  <div class='-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8'>
    <div class='py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8'>
      <div class='shadow overflow-hidden border-b border-gray-200 sm:rounded-lg'>
        <table class='min-w-full divide-y divide-gray-200'>
          <thead class='bg-gray-50'>
            <tr>
              <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                Title
              </th>
              <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                Price
              </th>
              <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                Payed
              </th>
              <th class='relative px-6 py-3'>
                <span class='sr-only'>Remove</span>
              </th>
            </tr>
          </thead>
          <tbody class='bg-white divide-y divide-gray-200'>
          	<?php foreach ($page_factor as $key => $value) {?>
            <tr>
              <td class='px-6 py-4 whitespace-nowrap'>
                <div class='text-sm text-gray-900'><?php echo a($value, 'title'). ' '. a($value, 'feature_key'); ?></div>
              </td>
              <td class='px-6 py-4 whitespace-nowrap'>
                <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>
                  <?php echo \dash\fit::number(a($value, 'price')) ?>
                </span>
                <div class='text-sm text-gray-500'><?php echo \lib\currency::unit() ?></div>
              </td>
              <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>
                <?php if(a($value, 'payed_before')) {echo 'payed';}else{echo 'not payed';} ?>
              </td>
              <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>
                <a href='#' class='text-indigo-600 hover:text-indigo-900'>Remove</a>
              </td>
            </tr>
	        <?php } //endif ?>

          </tbody>
        </table>

        <form method="post">
          <input type="hidden" name="pay" value="pay">
          <label class="toggle2">
          <span>Use as budget</span>
          <input type="checkbox" name="use_as_budget">
          </label>

          <button  class="btn-danger lg ">Pay</button>
        </form>

      </div>
    </div>
  </div>
</div>
