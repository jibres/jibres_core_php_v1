<?php
$planList = \dash\data::planList();
?>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-gray-100">
    <div class="pt-12 sm:pt-16 lg:pt-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl"><?php echo T_("Your current plan"); ?></h2>
                <p class="mt-4 text-xl text-gray-600">Must be show current plan days or notif for expire or can upgrade
                    and downgrade</p>
            </div>
        </div>
    </div>
    <div class="mt-8 bg-white pb-16 sm:mt-12 sm:pb-20 lg:pb-28">
        <div class="relative">
            <div class="absolute inset-0 h-1/2 bg-gray-100"></div>
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-lg overflow-hidden rounded-lg shadow-lg lg:flex lg:max-w-none">
                    <div class="flex-1 bg-white px-6 py-8 lg:p-12">
                        <h3 class="text-2xl font-bold text-gray-900 sm:text-3xl sm:tracking-tight"><?php echo \dash\data::myPlanDetail_planTitle() ?></h3>
                        <p class="mt-6 text-base text-gray-500"><?php echo \dash\data::myPlanDetail_planDescription() ?></p>
                        <?php if (\dash\data::myPlanDetail_planFeatureList()) : ?>
                            <div class="mt-8">
                                <div class="flex items-center">
                                    <h4 class="flex-shrink-0 bg-white pr-4 text-base font-semibold text-indigo-600">
                                        What's included</h4>
                                    <div class="flex-1 border-t-2 border-gray-200"></div>
                                </div>
                                <ul role="list"
                                    class="mt-8 space-y-5 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:gap-y-5 lg:space-y-0">
                                    <?php foreach (\dash\data::myPlanDetail_planFeatureList() as $feature) : ?>
                                        <li class="flex items-start lg:col-span-1">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <p class="ml-3 text-sm text-gray-700"><?php echo $feature ?></p>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="bg-gray-50 py-8 px-6 text-center lg:flex lg:flex-shrink-0 lg:flex-col lg:justify-center lg:p-12">
                        <p class="text-lg font-medium leading-6 text-gray-900">Pay once, own it forever</p>
                        <div class="mt-4 flex items-center justify-center text-5xl font-bold tracking-tight text-gray-900">
                            <span>$349</span>
                            <span class="ml-3 text-xl font-medium tracking-normal text-gray-500">USD</span>
                        </div>
                        <p class="mt-4 text-sm">
                            <a href="#" class="font-medium text-gray-500 underline">Learn about our membership
                                policy</a>
                        </p>
                        <div class="mt-6">
                            <div class="rounded-md shadow">
                                <a href="#"
                                   class="flex items-center justify-center rounded-md border border-transparent bg-gray-800 px-5 py-3 text-base font-medium text-white hover:bg-gray-900">Get
                                    Access</a>
                            </div>
                        </div>
                        <div class="mt-4 text-sm">
                            <a href="#" class="font-medium text-gray-900">
                                Get a free sample
                                <span class="font-normal text-gray-500">(20MB)</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>