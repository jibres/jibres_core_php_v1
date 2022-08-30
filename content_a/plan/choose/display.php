<?php
$planList    = \dash\data::planList();
$registerUrl = \dash\url::this();

if (\dash\request::get('p') == 'monthly') {
    $periodType = T_("month");
} else {
    $periodType = T_("year");
}

function HTMLValueDetectorPricing($value)
{
    if ($value === true) {
        return \dash\utility\icon::svg('Tick', 'minor', 'green', 'w-5 h-5');
    } elseif (is_string($value)) {
        return $value;
    } else {
        return \dash\utility\icon::svg('Minus', 'minor', '#DCDCDC', 'w-5 h-5');

    }
}


?>

<div class="bg-white">
    <div class="mx-auto max-w-7xl bg-white py-16 sm:py-24 sm:px-6 lg:px-8">
        <!-- xs to lg -->
        <div class="mx-auto max-w-2xl space-y-16 lg:hidden">
            <?php foreach ($planList as $plan) : ?>
                <section>
                    <div class="mb-8 px-4">
                        <?php if ($plan['price']): ?>
                            <h2 class="text-lg font-medium leading-6 text-gray-900"><?php echo $plan['title'] ?></h2>
                            <p class="mt-4">

                                <span class="text-4xl font-bold tracking-tight text-gray-900"><?php echo \dash\fit::number($plan['price']) ?> <small><?php echo $plan['currencyName']; ?></small></span>
                                <span class="text-base font-medium text-gray-500">/<?php echo $periodType; ?></span>

                            </p>
                        <?php else: ?>
                            <p class="mt-4">
                                <span class="text-4xl font-bold tracking-tight text-gray-900"><?php echo T_("Free"); ?></span>
                            </p>
                        <?php endif; ?>
                        <p class="mt-4 text-sm text-gray-500"><?php echo $plan['description'] ?></p>
                        <a href="<?php echo $registerUrl . '/' . $plan['name'] ?>"
                           class="mt-6 block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                            <?php echo $plan['title'] ?></a>
                    </div>

                    <?php foreach ($plan['featureList'] as $group => $list) : ?>

                        <table class="w-full">
                            <caption
                                    class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                                <?php echo $group ?>
                            </caption>
                            <tbody class="divide-y divide-gray-200">
                            <?php foreach ($list as $item => $v) : ?>
                                <tr class="border-t border-gray-200">
                                    <th class="py-5 px-4 text-left text-sm font-normal text-gray-500"
                                        scope="row"><?php echo $item ?></th>
                                    <td class="py-5 pr-4"><?php echo HTMLValueDetectorPricing($v); ?> </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endforeach; ?>
                    <div class="border-t border-gray-200 px-4 pt-5">
                        <a href="<?php echo $registerUrl . '/' . $plan['name'] ?>"
                           class="block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                            <?php echo $plan['title'] ?></a>
                    </div>
                </section>
            <?php endforeach; ?>


        </div>

        <!-- lg+ -->
        <div class="hidden lg:block">
            <table class="h-px w-full table-fixed">
                <caption class="sr-only">
                    Pricing plan comparison
                </caption>
                <thead>
                <tr>
                    <th class="px-6 pb-4 text-left text-sm font-medium text-gray-900" scope="col">
                        <span class="sr-only">Feature by</span>
                        <span>Plans</span>
                    </th>
                    <?php foreach ($planList as $plan) : ?>
                        <th class="w-1/4 px-6 pb-4 text-left text-lg font-medium leading-6 text-gray-900" scope="col">
                            <?php echo $plan['title'] ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 border-t border-gray-200">
                <tr>
                    <th class="py-8 px-6 text-left align-top text-sm font-medium text-gray-900" scope="row">Pricing</th>
                    <?php foreach ($planList as $plan) : ?>
                        <td class="h-full py-8 px-6 align-top">
                            <div class="relative table h-full">
                                <p>
                                    <?php if ($plan['price']) : ?>
                                        <span class="text-4xl font-bold tracking-tight text-gray-900"><?php echo \dash\fit::number($plan['price']) ?> <small><?php echo $plan['currencyName']; ?></small></span>
                                        <span class="text-base font-medium text-gray-500">/<?php echo $periodType; ?></span>
                                    <?php else: ?>
                                        <span class="text-4xl font-bold tracking-tight text-gray-900"><?php echo T_("Free"); ?></span>
                                    <?php endif; ?>
                                </p>
                                <p class="mt-4 mb-16 text-sm text-gray-500"><?php echo $plan['description'] ?></p>
                                <a href="<?php echo $registerUrl . '/' . $plan['name'] ?>"
                                   class="5 absolute bottom-0 block w-full flex-grow rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">
                                    <?php echo T_("Choose plan") ?></a>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <?php foreach (\dash\data::tableFeatureList() as $group => $list) : ?>
                    <tr>
                        <th class="bg-gray-50 py-3 pl-6 text-left text-sm font-medium text-gray-900"
                            colspan="<?php echo count($planList) + 1 ?>" scope="colgroup"><?php echo $group ?></th>
                    </tr>
                    <?php foreach ($list as $item => $value): ?>
                        <tr>
                            <th class="py-5 px-6 text-left text-sm font-normal text-gray-500"
                                scope="row"><?php echo $item ?></th>
                            <?php foreach ($value as $v) : ?>
                                <td class="py-5 px-6"><?php echo HTMLValueDetectorPricing($v); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr class="border-t border-gray-200">
                    <th class="sr-only" scope="row">Choose your plan</th>
                    <?php foreach ($planList as $plan) : ?>
                        <td class="px-6 pt-5">
                            <a href="<?php echo $registerUrl . '/' . $plan['name'] ?>"
                               class="block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                                <?php echo $plan['title'] ?></a>
                        </td>
                    <?php endforeach; ?>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
