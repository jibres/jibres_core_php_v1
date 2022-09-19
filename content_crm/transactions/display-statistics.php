<?php if(\dash\data::calcSum()) { ?>
    <div class="p-2 bg-white my-2 rounded-lg" data-kerkere=".showTransactionStatisticsList" data-kerkere-icon>
		<?php echo T_("Statistics of this list") ?>
    </div>
    <div class="showTransactionStatisticsList" data-kerkere-content="hide">
        <table class="tbl1 v4">
            <tbody>
            <tr class="positive">
                <th colspan="2"><?php echo T_("Plus transaction") ?></th>
            </tr>
            <tr class="positive">
                <td colspan="collapsing"><?php echo T_("Sum") ?></td>
                <td><?php echo \dash\fit::number(\dash\data::calcSum_sum_plus()) ?></td>
            </tr>
            <tr class="positive">
                <td colspan="collapsing"><?php echo T_("Average") ?></td>
                <td><?php echo \dash\fit::number(\dash\data::calcSum_avg_plus()) ?></td>
            </tr>
            <tr class="positive">
                <td colspan="collapsing"><?php echo T_("Count") ?></td>
                <td><?php echo \dash\fit::number(\dash\data::calcSum_count_plus()) ?></td>
            </tr>

            <tr class="negative">
                <th colspan="2"><?php echo T_("Minus transaction") ?></th>
            </tr>
            <tr class="negative">
                <td colspan="collapsing"><?php echo T_("Sum") ?></td>
                <td><?php echo \dash\fit::number(\dash\data::calcSum_sum_minus()) ?></td>
            </tr>
            <tr class="negative">
                <td colspan="collapsing"><?php echo T_("Average") ?></td>
                <td><?php echo \dash\fit::number(\dash\data::calcSum_avg_minus()) ?></td>
            </tr>
            <tr class="negative">
                <td colspan="collapsing"><?php echo T_("Count") ?></td>
                <td><?php echo \dash\fit::number(\dash\data::calcSum_count_minus()) ?></td>
            </tr>
            </tbody>
        </table>

    </div>


<?php } //endif ?>
