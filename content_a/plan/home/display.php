<?php
$planList     = \dash\data::planList();



?>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="max-w-7xl mx-auto py-24 px-4 bg-white sm:px-6 lg:px-8">

  <h2 class="text-3xl tracking-tight font-bold text-gray-900 sm:text-5xl sm:tracking-tight sm:leading-none lg:text-6xl lg:tracking-tight">Pricing plans for teams of all sizes</h2>
  <p class="mt-6 max-w-2xl text-xl text-gray-500">Choose an affordable plan that's packed with the best features for engaging your audience, creating customer loyalty, and driving sales.</p>
  <div class="mt-24 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-8">
  <?php foreach ($planList as $plan) : ?>
  <!-- Tiers -->
    <div class="relative p-8 mx-1 bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col">
      <div class="flex-1">
        <h3 class="text-xl font-semibold text-gray-900"><?php echo $plan['title']; ?></h3>
        <p class="mt-4 flex items-baseline text-gray-900">
          <span class="text-5xl tracking-tight font-bold"><?php echo \dash\fit::number($plan['price']) ?> <small><?php echo $plan['currencyName']; ?></small></span>
          <span class="ml-1 text-xl font-semibold">/<?php echo T_("month") ?></span>
        </p>
        <p class="mt-6 text-gray-500">The essentials to provide your best work for clients.</p>

        <!-- Feature list -->
        <ul role="list" class="mt-6 space-y-6">
            <?php foreach ($plan['featureList'] as $feature) : ?>
          <li class="flex">
            <!-- Heroicon name: outline/check -->
            <svg class="flex-shrink-0 w-6 h-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span class="ml-3 text-gray-500"><?php echo $feature ?></span>
          </li>

        <?php endforeach; ?>

        </ul>
      </div>

        <?php if($plan['isActive']) :?>
            <div class="alert-success"><?php echo T_("Active"); ?></div>
        <?php endif; ?>

      <div data-ajaxify data-data='{"plan": "<?php echo $plan['name'] ?>"}' class="bg-indigo-50 text-indigo-700 hover:bg-indigo-100 mt-8 block w-full py-3 px-6 border border-transparent rounded-md text-center font-medium">Monthly billing</div>
    </div>

<?php endforeach; ?>
  </div>


</div>
