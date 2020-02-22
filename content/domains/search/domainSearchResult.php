 <div class="result ltr">
    <?php if(\dash\data::infoResult()) {?>
        <?php foreach (\dash\data::infoResult() as $key => $value) {?>
            <?php if(isset($value['soon']) && $value['soon']) {?>
                <div class="msg minimal mB5">
                    <div class="f align-center pL10">
                        <div class="c pR10"><span class="name"><?php if(isset($value['name'])) {echo $value['name'];} else {echo $key;} ?></span> <span class="tld txtB"><?php if(isset($value['tld'])) echo '.'.$value['tld'] ?></span><?php if(isset($value['paperwork'])) echo '<span class="badge light mLa10">'.$value['paperwork']. '</span>'; ?></div>
                        <div class="cauto pR20"></div>
                        <div class="cauto">
                            <a class="btn"><?php echo T_("Coming Soon"); ?></a>
                        </div>
                    </div>
                </div>
            <?php continue; ?>
            <?php }// endif ?>

            <?php if(isset($value['available']) && $value['available']) {?>

                <div class="msg minimal mB5 success2">
                    <div class="f align-center pL10">
                        <div class="c pR10"><span class="name"><?php if(isset($value['name'])) {echo $value['name'];} else {echo $key;} ?></span> <span class="tld txtB"><?php if(isset($value['tld'])) echo '.'.$value['tld'] ?></span><?php if(isset($value['paperwork'])) echo '<span class="badge light mLa10">'.$value['paperwork']. '</span>'; ?></div>
                        <div class="cauto pR20"><span class="compact"><?php echo T_($value['unit']). ' '. \dash\fit::number($value['price']) ?></span> / <del class="compact fc-mute"><?php echo \dash\fit::number($value['compareAtPrice']); ?></del></div>
                        <div class="cauto">
                            <a class="btn success" href="<?php echo \dash\url::kingdom(); ?>/my/domain/buy/<?php echo $key; ?>"><?php echo T_("Buy"); ?></a>
                        </div>
                    </div>
                </div>

            <?php }else{ ?>

                <div class="msg minimal mB5 danger2<?php if(isset($value['paperwork']) && $value['paperwork'] ==='unavailable') echo ' disabled'?>">
                    <div class="f align-center pL10">
                        <div class="c pR10"><span class="name"><?php if(isset($value['name'])) {echo $value['name'];} else {echo $key;} ?></span> <span class="tld txtB"><?php if(isset($value['tld'])) echo '.'.$value['tld'] ?></span><?php if(isset($value['paperwork'])) echo '<span class="badge light mLa10">'.$value['paperwork']. '</span>'; ?></div>
                        <div class="cauto pR20"><?php if(isset($value['tld']) && $value['tld'] === 'ایران') echo T_("unavailable"); else echo T_("Taken"); ?></div>
                        <div class="cauto">
                            <a class="btn light" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo urlencode($key); ?>"><?php echo T_("Whois taken?"); ?></a>
                        </div>
                    </div>
                </div>

            <?php } ?>

        <?php } //endforeach ?>


    <?php }elseif(\dash\request::get('q')){ ?>

        <div class="msg warn2">
            <div class="f">
                <div class="c">

                    <?php echo T_("Can not register this domain"); ?>
                </div>
                <div class="cauto">
                    <a class="btn pain mLR10" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Who is?"); ?></a>
                </div>
                <div class="cauto">
                    <a class="btn warn" href="<?php echo \dash\url::kingdom(); ?>/domains/search"><?php echo T_("Try another"); ?></a>
                </div>
            </div>
        </div>

    <?php } //endif ?>
  </div>