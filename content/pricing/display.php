

<?php
require_once ('priceTable.php');
?>



<section class="guaranteeBox">
  <div class="cn">
    <div class="f">
      <div class="c7 s12 pRa20">
        <div class="text">
          <h2><?php echo T_("30 day satisfaction guarantee"); ?></h2>
          <h3><?php echo T_("no questions asked!"); ?></h3>
          <p><?php echo T_("We stand behind our service and we mean it!"); ?> <?php echo T_("Despite our offer 14 days free trial to start use Jibres,"); ?> <?php echo T_("if at any time within the first 30 days period you are not happy with Jibres, you can request money back and we will refund it."); ?>
          </p>
        </div>
      </div>
      <div class="c5 s12">
        <img class="preview" src="<?php echo \dash\url::cdn(); ?>/images/homepage/guaranteeBadge.png" alt='<?php echo \dash\face::site(); ?> <?php echo T_("30 day Guarantee"); ?>'>
      </div>
    </div>
  </div>
</section>




<div class="cn">

<div class="tblBox">

<table class="tbl1 v10 pricingTable">
  <thead>
    <tr>
      <th></th>
      <th><?php echo T_("Free"); ?></th>
      <th><?php echo T_("Bronze"); ?></th>
      <th><?php echo T_("Silver"); ?></th>
      <th><?php echo T_("Gold"); ?></th>
    </tr>
  </thead>
  <tbody>
      <tr class="fs14">
        <th class="txtB"><?php echo T_("Price"); ?> <small><?php echo T_("Pay monthly"); ?></small></th>
        <td class="txtB"><?php echo T_("FREE"); ?></td>
<?php
if(\dash\language::current() === 'fa')
{
?>
        <td class="txtB"><?php echo \dash\fit::number('14'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('30'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('75'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
<?php
}
else
{
?>
        <td>14<small>$</small></td>
        <td>30<small>$</small></td>
        <td>75<small>$</small></td>
<?php
} // endif
?>
      </tr>

      <tr class="fs14">
        <th class="txtB"><?php echo T_("Price"); ?> <small><?php echo T_("Pay yearly"); ?></small>
          <span class="badge sm mLa10"><?php echo T_("Two month free"); ?></span>
        </th>
        <td class="txtB"><?php echo T_("FREE"); ?></td>
<?php
if(\dash\language::current() === 'fa')
{
?>
        <td class="txtB"><?php echo \dash\fit::number('140'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('300'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('750'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
<?php
}
else
{
?>
        <td>140<small>$</small></td>
        <td>300<small>$</small></td>
        <td>750<small>$</small></td>
<?php
} // endif
?>
      </tr>

<?php
if(false)
{
?>
      <tr class="fs14">
        <th class="txtB"><?php echo T_("Price"); ?> <small><?php echo T_("Pay yearly"); ?></small>
          <span class="badge success sm mLa10"><?php echo T_("First Year"); ?></span>
          <span class="badge sm mLa10"><?php echo T_("More than 50 percent off"); ?></span>
        </th>
<?php
if(\dash\language::current() === 'fa')
{
?>
        <td class="txtB"><?php echo \dash\fit::number('50'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('150'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('300'); ?> <small><?php echo T_("Hezar Toman"); ?></small></td>
<?php
}
else
{
?>
        <td>140<small>$</small></td>
        <td>300<small>$</small></td>
        <td>750<small>$</small></td>
<?php
} // endif
?>
      </tr>
<?php
} // endif
?>


      <tr>
        <th colspan="5"><?php echo T_("Data max limit"); ?></th>
      </tr>
      <tr>
        <th><?php echo T_("Max product"); ?></th>
        <td><?php echo \dash\fit::number('100'); ?></td>
        <td><?php echo \dash\fit::number('1000'); ?></td>
        <td><?php echo T_("Unlimited"); ?></td>
        <td><?php echo T_("Unlimited"); ?></td>
      </tr>
      <tr>
        <th><?php echo T_("Max third party"); ?></th>
        <td><?php echo \dash\fit::number('100'); ?></td>
        <td><?php echo \dash\fit::number('1000'); ?></td>
        <td><?php echo T_("Unlimited"); ?></td>
        <td><?php echo T_("Unlimited"); ?></td>
      </tr>
      <tr>
        <th><?php echo T_("Max invoice each day"); ?></th>
        <td><?php echo \dash\fit::number('100'); ?></td>
        <td><?php echo \dash\fit::number('1000'); ?></td>
        <td><?php echo T_("Unlimited"); ?></td>
        <td><?php echo T_("Unlimited"); ?></td>
      </tr>
      <tr>
        <th><?php echo T_("Max item in each invoice"); ?></th>
        <td><?php echo \dash\fit::number('10'); ?></td>
        <td><?php echo \dash\fit::number('100'); ?></td>
        <td><?php echo T_("Unlimited"); ?></td>
        <td><?php echo T_("Unlimited"); ?></td>
      </tr>


      <tr>
        <th colspan="5" class="txtRa"><?php echo T_("Basic Features"); ?></th>
      </tr>
<?php
if(\dash\language::current() === 'fa')
{
?>
      <tr>
        <th><?php echo T_("Each SMS cost"); ?> <span class="badge lg"><?php echo T_("Optional"); ?></span></th>
        <td class="txtB"><?php echo \dash\fit::number('100'); ?> <small><?php echo \lib\currency::unit(); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('75'); ?> <small><?php echo \lib\currency::unit(); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('40'); ?> <small><?php echo \lib\currency::unit(); ?></small></td>
        <td class="txtB"><?php echo \dash\fit::number('30'); ?> <small><?php echo \lib\currency::unit(); ?></small></td>
      </tr>
<?php
} // endif
?>
      <tr>
        <th><?php echo T_("Integrated Sales"); ?></th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Free Invoicing"); ?></th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Online Accounting"); ?></th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Sale on social networks"); ?></th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Search Engine Optimized"); ?></th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>


      <tr>
        <th colspan="5" class="txtRa"><?php echo T_("Starter Features"); ?></th>
      </tr>
      <tr>
        <th><?php echo T_("vCard Website"); ?></th>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Staff Accounts"); ?></th>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("vCard Website"); ?></th>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>


      <tr>
        <th colspan="5" class="txtRa"><?php echo T_("Simple Features"); ?></th>
      </tr>
      <tr>
        <th><?php echo T_("Advance Reports"); ?></th>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("All Invoice Types"); ?></th>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Product Intro Website"); ?></th>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Advance Settings"); ?></th>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>


      <tr>
        <th colspan="5" class="txtRa"><?php echo T_("Standard Features"); ?></th>
      </tr>
      <tr>
        <th><?php echo T_("Online Store"); ?></th>
        <td>❌</td>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("News website"); ?></th>
        <td>❌</td>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Online Shop with Your Domain"); ?></th>
        <td>❌</td>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th><?php echo T_("Full Permission Control"); ?></th>
        <td>❌</td>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
      </tr>



  </tbody>
</table>
</div>
</div>





 <div class="tile" id='offer-enterprise-small'>
  <div class="cn f align-center">
   <div class="c s12">
    <h3><?php echo T_("Ready to use Jibres Enterprise?"); ?></h3>
    <h4><?php echo T_("Get started with our Enterprise plan."); ?></h4>
   </div>
   <div class="c3 m4 s12">
    <a href="<?php \dash\url::here(); ?>/enterprise" class="btn bg-white"><?php echo T_("Get in Touch"); ?></a>
   </div>
   <div class="c1 s12"></div>
  </div>
 </div>


 <div class="pc">
  <div class="cn f">
   <div class="c6 s12">
    <h3><?php echo T_("Billing & Invoicing"); ?></h3>
     <ul class="faq">
      <li>
       <h4><?php echo T_("Is there a setup fee?"); ?></h4>
       <p><?php echo T_("No. There are no setup fees on any of our plans!"); ?></p>
      </li>

      <li>
       <h4><?php echo T_("Can I cancel my account at any time?"); ?></h4>
       <p><?php echo T_("Yes. If you ever decide that Jibres isn’t the best platform for your business, simply cancel your account."); ?></p>
      </li>

      <li>
       <h4><?php echo T_("How long are your contracts?"); ?></h4>
       <p><?php echo T_("All Jibres plans are month to month. simple."); ?></p>
      </li>
      <li>
       <h4><?php echo T_("Can I change my plan later on?"); ?></h4>
       <p><?php echo T_("Absolutely! You can upgrade or downgrade your plan at any time."); ?></p>

      <li>
       <h4><?php echo T_("When is my billing date?"); ?></h4>
       <p><?php echo T_("The date you first select a paid plan will be the recurring billing date. For example: If you sign up for the first time on July 15, all future charges will be billed on the 15th of every month."); ?></p>
      </li>
    </ul>
   </div>

   <div class="c6 s12">
    <h3><?php echo T_("General questions"); ?></h3>
    <ul class="ps faq">
     <li>
      <h4><?php echo T_("How does Jibres work?"); ?></h4>
      <p><?php echo T_("The easiest way to learn how to use Jibres is enter to it, which takes less than 3 minutes to setup your team."); ?></p>
     </li>
     <li>
      <h4><?php echo T_("What is your privacy and security policy?"); ?></h4>
      <p><?php echo T_("View Jibres's privacy and security policy at"); ?> <a href='<?php \dash\url::here(); ?>/privacy'><?php \dash\url::here(); ?>/privacy</a></p>
     </li>
     <li>
      <h4><?php echo T_("Where can I find your Terms of Service (TOS)?"); ?></h4>
      <p><?php echo T_("You can find them at"); ?>  <a href='<?php \dash\url::here(); ?>/terms'><?php \dash\url::here(); ?>/terms</a></p>
     </li>
     <li>
      <h4><?php echo T_("What are your bandwidth fees?"); ?></h4>
      <p><?php echo T_("There are none. All Jibres plans include unlimited bandwidth for free."); ?></p>
     </li>
     <li>
      <h4><?php echo T_("Do I need a web host?"); ?></h4>
      <p><?php echo T_("No! Jibres includes secure, unlimited hosting on all plans with free bandwith."); ?></p>
     </li>
    </ul>
   </div>

  </div>
 </div>

