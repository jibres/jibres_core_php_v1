<div class="jibresBanner">
    <div class="avand-lg impact zero">
        <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/bg/jibres-changelog-1.jpg" alt='<?php echo \dash\face::title();?>'>
    </div>

    <div class="avand-lg zero impact">
        <?php if(\dash\request::get('tag')) {?>
            <div class="alert-dark mb-0">
                <div class="row align-center">
                    <div class="c-auto"><?php echo T_("You are watching the changelog of the project with the :tag tag", ['tag' => '#'.\dash\request::get('tag')]) ?></div>
                    <div class="c"></div>
                    <div class="c-auto"><a class="btn-secondary" href="<?php echo \dash\url::this() ?>"><?php echo T_("Click to view all"); ?></a></div>
                </div>
            </div>
        <?php } //ednif ?>
    </div>
        <?php if(\dash\data::myTable() || \dash\request::get()) {?>
            <?php foreach (\dash\data::myTable() as $year => $year_detail) { ?>
                <div class="avand-lg impact zero">
                    <table class="tbl1 v10 text-sm mb-0 responsive">
                        <tbody>
                            <?php if($year === 'soon') {?>
                            <tr>
                                <td class="collapsing">...</td>
                                <td><?php echo T_("We are Developers, please wait!"); ?></td>
                            </tr>
                        <?php } //endif ?>
                            <?php foreach ($year_detail as $key => $value) {?>
                                <tr>
                                    <td class="collapsing"><?php if(a($value, 'date') && strtotime($value['date']) < time()) {echo \dash\fit::date(a($value, 'date'), 'readable');}else{echo T_("Soon");} ?></td>
                                    <td class="w-full"><?php echo a($value, 'title'); ?>
                                    <?php if(a($value, 'link')) {?><a class="inline-block" target="_blank" href="<?php echo a($value, 'link') ?>"> <?php echo T_("Read more") ?></a><?php } ?>
                                    <?php if(a($value, 'tag1')) { echo '<a class="inline-block" href="'.\dash\url::this(). '?tag='. urlencode(a($value, 'tag1')).'"> #'. $value['tag1']. '</a>';} ?>
                                    <?php if(a($value, 'tag2')) { echo '<a class="inline-block" href="'.\dash\url::this(). '?tag='. urlencode(a($value, 'tag2')).'"> #'. $value['tag2']. '</a>';} ?>
                                    <?php if(a($value, 'tag3')) { echo '<a class="inline-block" href="'.\dash\url::this(). '?tag='. urlencode(a($value, 'tag3')).'"> #'. $value['tag3']. '</a>';} ?>
                                    <?php if(a($value, 'tag4')) { echo '<a class="inline-block" href="'.\dash\url::this(). '?tag='. urlencode(a($value, 'tag4')).'"> #'. $value['tag4']. '</a>';} ?>
                                    <?php if(a($value, 'tag5')) { echo '<a class="inline-block" href="'.\dash\url::this(). '?tag='. urlencode(a($value, 'tag5')).'"> #'. $value['tag5']. '</a>';} ?>
                                </td>
                            </tr>
                        <?php } //endfor ?>
                    </tbody>
                </table>
            </div>
        <?php } //endfor ?>
        <?php \dash\utility\pagination::html(); ?>

    <?php }else{ ?>
 <div class="avand-lg impact zero">


        <table class="tbl1 v10 text-sm mb-0">
            <thead>
                <tr>
                    <th class="collapsing"><?php echo T_("Date"); ?></th>
                    <th><?php echo T_("Description"); ?></th>
                    <th class="collapsing"></th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>...</td>
                    <td><?php echo T_("We are Developers, please wait!"); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo T_("Soon"); ?></td>
                    <td><?php echo T_("Version 1 of Jibres will be released."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2021-02-16"); ?></td>
                    <td><?php echo T_("Upgrade our powerful ticketing system. Try it, Love it"); ?></td>
                    <td>😎❤️</td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2021-01-01"); ?></td>
                    <td><?php echo T_("happy New Year"); ?> <?php echo \dash\fit::number("2021", false); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2020-07-21"); ?></td>
                    <td><?php echo T_("The first online sale was registered on our first online store website.");?></td>
                    <td>🎉❤️</td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2020-04-05"); ?></td>
                    <td><?php echo T_("Now Jibres is official reseller of :val. You can buy iranian national domain .ir via Jibres.", ['val' => '<a target="_blank" href="http://irnic.ir/List_of_Resellers">'. T_("IRNIC"). '</a>']);?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2020-03-30"); ?></td>
                    <td><?php echo T_("Our app generator is finished. Now we have a factory to create android application for our business."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2020-03-20"); ?></td>
                    <td><?php echo T_("happy Nowruz"); ?> <?php echo \dash\fit::number("1399", false); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2020-02-23"); ?></td>
                    <td><?php echo T_("COVID-19 is come and we are release our 60 percent of our employees! GOD bless us..."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2020-02-02"); ?></td>
                    <td><?php echo T_(":val is ready.", ['val' => '<a target="_blank" href="'. \dash\url::kingdom(). '/catalog">'. T_("Jibres catalog"). '</a>']);?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2020-01-01"); ?></td>
                    <td><?php echo T_("happy New Year"); ?> <?php echo \dash\fit::number("2020", false); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2019-12-17"); ?></td>
                    <td><?php echo T_("Jibres presend features at Advertising & Marketing 2019 Tehran, Iran. 17 - 20 Dec 2019."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2019-12-06"); ?></td>
                    <td><?php echo T_("Jibres brand is reborn."); ?> <a href="<?php ?>"><?php echo "Read More about Jibres brand style guide."; ?></a></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2019-09-25"); ?></td>
                    <td><?php echo T_("Beta version is released."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2019-02-07"); ?></td>
                    <td><?php echo T_("add support of digital scale barcode and get weight of product automatically."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2018-11-10"); ?></td>
                    <td><?php echo T_("We reach 1B+ Toman sold on Jibres."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2018-02-04"); ?></td>
                    <td><?php echo T_("We reach 100M+ Toman sold on Jibres."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2018-01-30"); ?></td>
                    <td><?php echo T_("We reach 10000 factor records."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2017-12-20"); ?></td>
                    <td><?php echo T_("First factor of first store is generated."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2017-12-12"); ?></td>
                    <td><?php echo T_("Our first store on web is created and start add product to store."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2017-11-26"); ?></td>
                    <td><?php echo T_("Alfa version is released."); ?></td>
                    <td></td>
                </tr>

                <tr class="active">
                    <td><?php echo \dash\fit::date("2017-10-23"); ?></td>
                    <td><?php echo T_("We restart plans to run Jibres at Ermile."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2014-10-18"); ?></td>
                    <td><?php echo T_("The name of project selected as Jibres and <a href='https://Jibres.ir' target='_blank'>Jibres.ir</a> and <a href='https://Jibres.com'>Jibres.com</a> domains are registered."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2014-10-10"); ?></td>
                    <td><?php echo T_("Create git repository and first commit is pushed."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><?php echo \dash\fit::date("2014-05-31"); ?></td>
                    <td><?php echo T_("Database is completely designed and implementated."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td title='<?php echo T_("02:00 AM"); ?>'><?php echo \dash\fit::date("2013-11-10"); ?></td>
                    <td><?php echo T_("Start database analysis of Jibres."); ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td>...</td>
                    <td><?php echo T_("We were born to do Best!"); ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

</div>
    <?php } //endif ?>

<div class="avand-lg impact zero">
    <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/bg/jibres-changelog-2.jpg" alt='<?php echo T_('We are preparing to create something amazing in Jibres.')?>'>
</div>

</div>