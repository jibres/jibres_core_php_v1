{%extends display.main%}


{%set ft%}<div class="c s2">✔️</div>{%endset%}
{%set ff%}<div class="c s2">-</div>{%endset%}
{%set f1%}<div class="c s2">{{1 | fitNumber}}</div>{%endset%}
{%set f3%}<div class="c s2">{{3 | fitNumber}}</div>{%endset%}
{%set f10%}<div class="c s2">{{10 | fitNumber}}</div>{%endset%}
{%set f100%}<div class="c s2">{{100 | fitNumber}}</div>{%endset%}
{%set fadmin%}<div class="c s2">{%trans "only team admin"%}</div>{%endset%}
{%set fu%}<div class="c s2">{%trans "Unlimited"%}</div>{%endset%}



{%block pageData%}

{%include 'content/pricing/priceTable.html'%}


{{block ("guarantee")}}


<div class="cn">
{{block ("pagePriceTable")}}
</div>

{%endblock%}


{%block pagePriceTable%}
<div class="tblBox">

<table class="tbl1 v10 pricingTable">
  <thead>
    <tr>
      <th></th>
      <th>{%trans "Free"%}</th>
      <th>{%trans "Bronze"%}</th>
      <th>{%trans "Silver"%}</th>
      <th>{%trans "Gold"%}</th>
    </tr>
  </thead>
  <tbody>
      <tr class="fs14">
        <th class="txtB">{%trans "Price"%} <small>{%trans "Pay monthly"%}</small></th>
        <td class="txtB">{%trans "FREE"%}</td>
{%if lang.current == 'fa'%}
        <td class="txtB">{{"14" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
        <td class="txtB">{{"30" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
        <td class="txtB">{{"75" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
{%else%}
        <td>14<small>$</small></td>
        <td>30<small>$</small></td>
        <td>75<small>$</small></td>
{%endif%}
      </tr>

      <tr class="fs14">
        <th class="txtB">{%trans "Price"%} <small>{%trans "Pay yearly"%}</small>
          <span class="badge sm mLa10">{%trans "Two month free"%}</span>
        </th>
        <td class="txtB">{%trans "FREE"%}</td>
{%if lang.current == 'fa'%}
        <td class="txtB">{{"140" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
        <td class="txtB">{{"300" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
        <td class="txtB">{{"750" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
{%else%}
        <td>140<small>$</small></td>
        <td>300<small>$</small></td>
        <td>750<small>$</small></td>
{%endif%}
      </tr>

{%if false%}
      <tr class="fs14">
        <th class="txtB">{%trans "Price"%} <small>{%trans "Pay yearly"%}</small>
          <span class="badge success sm mLa10">{%trans "First Year"%}</span>
          <span class="badge sm mLa10">{%trans "More than 50 percent off"%}</span>
        </th>
{%if lang.current == 'fa'%}
        <td class="txtB">{{"50" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
        <td class="txtB">{{"150" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
        <td class="txtB">{{"300" | fitNumber}} <small>{%trans "Hezar Toman"%}</small></td>
{%else%}
        <td>140<small>$</small></td>
        <td>300<small>$</small></td>
        <td>750<small>$</small></td>
{%endif%}
      </tr>
{%endif%}


      <tr>
        <th colspan="5">{%trans "Data max limit"%}</th>
      </tr>
      <tr>
        <th>{%trans "Max product"%}</th>
        <td>{{"100" | fitNumber}}</td>
        <td>{{"1000" | fitNumber}}</td>
        <td>{%trans "Unlimited"%}</td>
        <td>{%trans "Unlimited"%}</td>
      </tr>
      <tr>
        <th>{%trans "Max third party"%}</th>
        <td>{{"100" | fitNumber}}</td>
        <td>{{"1000" | fitNumber}}</td>
        <td>{%trans "Unlimited"%}</td>
        <td>{%trans "Unlimited"%}</td>
      </tr>
      <tr>
        <th>{%trans "Max invoice each day"%}</th>
        <td>{{"100" | fitNumber}}</td>
        <td>{{"1000" | fitNumber}}</td>
        <td>{%trans "Unlimited"%}</td>
        <td>{%trans "Unlimited"%}</td>
      </tr>
      <tr>
        <th>{%trans "Max item in each invoice"%}</th>
        <td>{{"10" | fitNumber}}</td>
        <td>{{"100" | fitNumber}}</td>
        <td>{%trans "Unlimited"%}</td>
        <td>{%trans "Unlimited"%}</td>
      </tr>


      <tr>
        <th colspan="5" class="txtRa">{%trans "Basic Features"%}</th>
      </tr>
{%if lang.current == 'fa'%}
      <tr>
        <th>{%trans "Each SMS cost"%} <span class="badge lg">{%trans "Optional"%}</span></th>
        <td class="txtB">{{"100" | fitNumber}} <small>{%trans "Toman"%}</small></td>
        <td class="txtB">{{"75" | fitNumber}} <small>{%trans "Toman"%}</small></td>
        <td class="txtB">{{"40" | fitNumber}} <small>{%trans "Toman"%}</small></td>
        <td class="txtB">{{"30" | fitNumber}} <small>{%trans "Toman"%}</small></td>
      </tr>
{%endif%}
      <tr>
        <th>{%trans "Integrated Sales"%}</th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Free Invoicing"%}</th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Online Accounting"%}</th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Sale on social networks"%}</th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Search Engine Optimized"%}</th>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>


      <tr>
        <th colspan="5" class="txtRa">{%trans "Starter Features"%}</th>
      </tr>
      <tr>
        <th>{%trans "vCard Website"%}</th>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Staff Accounts"%}</th>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "vCard Website"%}</th>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>


      <tr>
        <th colspan="5" class="txtRa">{%trans "Simple Features"%}</th>
      </tr>
      <tr>
        <th>{%trans "Advance Reports"%}</th>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "All Invoice Types"%}</th>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Product Intro Website"%}</th>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Advance Settings"%}</th>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>


      <tr>
        <th colspan="5" class="txtRa">{%trans "Standard Features"%}</th>
      </tr>
      <tr>
        <th>{%trans "Online Store"%}</th>
        <td>❌</td>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "News website"%}</th>
        <td>❌</td>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Online Shop with Your Domain"%}</th>
        <td>❌</td>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
      </tr>
      <tr>
        <th>{%trans "Full Permission Control"%}</th>
        <td>❌</td>
        <td>❌</td>
        <td>❌</td>
        <td>✔️</td>
      </tr>



  </tbody>
</table>
</div>

{%endblock%}






{%block pageExtra%}
 <div class="tile" id='offer-enterprise-small'>
  <div class="cn f align-center">
   <div class="c s12">
    <h3>{%trans "Ready to use Jibres Enterprise?"%}</h3>
    <h4>{%trans "Get started with our Enterprise plan."%}</h4>
   </div>
   <div class="c3 m4 s12">
    <a href="{{url.here}}/enterprise" class="btn bg-white">{%trans "Get in Touch"%}</a>
   </div>
   <div class="c1 s12"></div>
  </div>
 </div>


 <div class="pc">
  <div class="cn f">
   <div class="c6 s12">
    <h3>{%trans "Billing & Invoicing"%}</h3>
     <ul class="faq">
      <li>
       <h4>{%trans "Is there a setup fee?"%}</h4>
       <p>{%trans "No. There are no setup fees on any of our plans!"%}</p>
      </li>

      <li>
       <h4>{%trans "Can I cancel my account at any time?"%}</h4>
       <p>{%trans "Yes. If you ever decide that Jibres isn’t the best platform for your business, simply cancel your account."%}</p>
      </li>

      <li>
       <h4>{%trans "How long are your contracts?"%}</h4>
       <p>{%trans "All Jibres plans are month to month. simple."%}</p>
      </li>
      <li>
       <h4>{%trans "Can I change my plan later on?"%}</h4>
       <p>{%trans "Absolutely! You can upgrade or downgrade your plan at any time."%}</p>

      <li>
       <h4>{%trans "When is my billing date?"%}</h4>
       <p>{%trans "The date you first select a paid plan will be the recurring billing date. For example: If you sign up for the first time on July 15, all future charges will be billed on the 15th of every month."%}</p>
      </li>
    </ul>
   </div>

   <div class="c6 s12">
    <h3>{%trans "General questions"%}</h3>
    <ul class="ps faq">
     <li>
      <h4>{%trans "How does Jibres work?"%}</h4>
      <p>{%trans "The easiest way to learn how to use Jibres is enter to it, which takes less than 3 minutes to setup your team."%}</p>
     </li>
     <li>
      <h4>{%trans "What is your privacy and security policy?"%}</h4>
      <p>{%trans "View Jibres's privacy and security policy at"%} <a href='{{url.here}}/privacy'>{{url.here}}/privacy</a></p>
     </li>
     <li>
      <h4>{%trans "Where can I find your Terms of Service (TOS)?"%}</h4>
      <p>{%trans "You can find them at"%}  <a href='{{url.here}}/terms'>{{url.here}}/terms</a></p>
     </li>
     <li>
      <h4>{%trans "What are your bandwidth fees?"%}</h4>
      <p>{%trans "There are none. All Jibres plans include unlimited bandwidth for free."%}</p>
     </li>
     <li>
      <h4>{%trans "Do I need a web host?"%}</h4>
      <p>{%trans "No! Jibres includes secure, unlimited hosting on all plans with free bandwith."%}</p>
     </li>
    </ul>
   </div>

  </div>
 </div>

{%endblock%}



{%block guarantee%}
<section class="guaranteeBox">
  <div class="cn">
    <div class="f">
      <div class="c7 s12 pRa20">
        <div class="text">
          <h2>{%trans "30 day satisfaction guarantee"%}</h2>
          <h3>{%trans "no questions asked!"%}</h3>
          <p>{%trans "We stand behind our service and we mean it!"%} {%trans "Despite our offer 14 days free trial to start use Jibres,"%} {%trans "if at any time within the first 30 days period you are not happy with Jibres, you can request money back and we will refund it."%}
          </p>
        </div>
      </div>
      <div class="c5 s12">
        <img class="preview" src="{{url.static}}/images/homepage/guaranteeBadge.png" alt='{{site.title}} {%trans "30 day Guarantee"%}'>
      </div>
    </div>
  </div>
</section>

{%endblock%}




