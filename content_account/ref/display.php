
  <div class="tbox">
    <h2><?php echo T_("Referral Program"); ?></h2>
    <p><?php echo T_("Nobody can tell the Jibres story better than you;)"); ?></p>
  </div>

  <div class="cbox">
    <h2><?php echo T_("How it works?"); ?></h2>
    <ul>
      <li>
       <h4><?php echo T_("Tell your friends about the Jibres story."); ?></h4>
       <p><?php echo T_("Refer your friends through Social Media or Email."); ?> <?php echo T_("Share the referral rewards program with friends on Facebook, Twitter, or Email."); ?> <?php echo T_("When they click on your post, we’ll know it was you who referred them."); ?> <?php echo T_("If someone forget to use your link, we allow to set your ref code as promo code in billing page!"); ?></p>
      </li>
      <li>
       <h4><?php echo T_("Your friend enter to Jibres and receives credit."); ?></h4>
       <p><?php echo T_("Your friend enter and receives $5 account credit."); ?> <?php echo T_("Anyone you refer to Jibres that enter using your unique referral link or your promo code will receive $5 in credit."); ?></p>
      </li>
      <li>
       <h4><?php echo T_("You all get rewarded."); ?></h4>
       <p><?php echo T_("Jibres rewards are charge in your account after 7 work days of confirmation."); ?> <?php echo T_("Amount of charge is depended on your friend total pay and after automatic calculation, system set your gift."); ?> <?php echo T_("We calculate your percentage until 6 month of your friend registration. Because of that it was your chance to convinced your friend to charge more!"); ?></p>
      </li>
    </ul>
  </div>

  <div class="cbox">
    <h3><?php echo T_("Share your link"); ?></h3>
    <p><?php echo T_("Copy your personal referral link and share it with your friends and followers."); ?></p>

    <div class="input pTB10 w400">
      <label class="addon" for="youRefLink"><?php echo T_("Link"); ?></label>
      <input type="text" id="youRefLink" readonly value="jibres.com?ref=<?php echo \dash\user::code(); ?>" class="ltr">
      <button class="addon btn primary" data-copy='#youRefLink'>Copy <span class="sf-link"></span></button>
    </div>
    <div class="input pTB10 w400">
      <label class="addon" for="youRefPromo"><?php echo T_("Promo code"); ?></label>
      <input type="text" id="youRefPromo" readonly value="ref=<?php echo \dash\user::code(); ?>" class="ltr">
      <button class="addon btn primary" data-copy='#youRefPromo'>Copy <span class="sf-link"></span></button>
    </div>
  </div>

