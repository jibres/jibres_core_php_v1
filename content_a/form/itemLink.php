<nav class="items">
    <ul>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/dashboard?id=' . \dash\request::get('id'); ?>">
                <i class="sf-gauge"></i>
                <div class="key"><?php echo T_("Form Dashboard"); ?></div>
                <div class="go"></div>
            </a></li>
    </ul>
</nav>


<nav class="items">
    <ul>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/edit?id=' . \dash\request::get('id'); ?>">
                <i class="sf-list-ul"></i>
                <div class="key"><?php echo T_("Items list"); ?></div>
                <div class="go"></div>
            </a></li>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/setting?id=' . \dash\request::get('id'); ?>">
                <i class="sf-pencil-square-o"></i>
                <div class="key"><?php echo T_("Edit form setting"); ?></div>
                <div class="go"></div>
            </a></li>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/thankyou?id=' . \dash\request::get('id'); ?>">
                <i class="sf-heart-o"></i>
                <div class="key"><?php echo T_("Thank you message"); ?></div>
                <div class="go"></div>
            </a></li>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/status?id=' . \dash\request::get('id'); ?>">
                <i class="sf-plug"></i>
                <div class="key"><?php echo T_("Status"); ?></div>
                <div class="go"></div>
            </a></li>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/sorting?id=' . \dash\request::get('id'); ?>">
                <i class="sf-sort"></i>
                <div class="key"><?php echo T_("Sort items"); ?></div>
                <div class="go"></div>
            </a></li>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/tag?id=' . \dash\request::get('id'); ?>">
                <i class="sf-tag"></i>
                <div class="key"><?php echo T_("Tags"); ?></div>
                <div class="go"></div>
            </a></li>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/condition?id=' . \dash\request::get('id'); ?>">
                <i class="sf-atom"></i>
                <div class="key"><?php echo T_("Form condition"); ?></div>
                <div class="go"></div>
            </a></li>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/inquiry?id=' . \dash\request::get('id'); ?>">
                <i class="sf-group-full"></i>
                <div class="key"><?php echo T_("Inquiry"); ?></div>
                <div class="go"></div>
            </a></li>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/resultpage?id=' . \dash\request::get('id'); ?>">
                <i class="sf-list-ul"></i>
                <div class="key"><?php echo T_("Result Page"); ?></div>
                <div class="go"></div>
            </a></li>

    </ul>
</nav>

<nav class="items">
    <ul>
        <li><a class="f item" href="<?php echo \dash\url::this() . '/answer?id=' . \dash\request::get('id'); ?>">
                <i class="sf-file"></i>
                <div class="key"><?php echo T_("Answers"); ?></div>
                <div class="go"></div>
            </a></li>

        <li><a class="f item" href="<?php echo \dash\url::this() . '/report?id=' . \dash\request::get('id'); ?>">
                <i class="sf-pie-chart"></i>
                <div class="key"><?php echo T_("Reports"); ?></div>
                <div class="go"></div>
            </a></li>
    </ul>
</nav>


<?php if(\content_a\form\analytics\controller::check_count_answer_1000()) { ?>
    <nav class="items">
        <ul>
            <li><a class="f item" href="<?php echo \dash\url::this() . '/analytics?id=' . \dash\request::get('id'); ?>">
                    <i class="sf-atom"></i>
                    <div class="key"><?php echo T_("Analyze answers"); ?></div>
                    <div class="go"></div>
                </a></li>
        </ul>
    </nav>
<?php } //endif ?>


<nav class="items">
    <ul>
        <li>
            <a class="f" href="<?php echo \dash\url::this() . '/item/add?id=' . \dash\request::get('id') ?>">
                <div class="go plus ok"></div>
                <div class="key"><?php echo T_("Add new question") ?></div>
            </a>
        </li>
    </ul>
</nav>
