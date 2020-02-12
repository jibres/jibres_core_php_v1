{%extends display.main%}


{%block page%}

 <div class="f content">
  <div class="c6 s12">
   <p>{%trans "Thank you for choosing us."%}<br/>{%trans "We do our best to improve jibres's quality. So, knowing your valuable comments about bugs and problems and more importantly your precious offers will help us in this way."%}</p>
   <form method="post" data-clear>
    {%include display.hive%}
   {%if login%}
   {%else%}
    <div class="input pA5">
     <label class="addon" for="name">{%trans "Name"%}</label>
     <input type="text" name="name" id="name" placeholder='{%trans "Full Name"%}' maxlength='40'>
    </div>
    <div class="input pA5">
     <label class="addon" for="mobile">{%trans "Mobile"%}</label>
     <input type="tel" name="mobile" id="mobile" placeholder='98 912 333 4444' maxlength="17" autocomplete="off" data-validity='{%trans "Please enter valid mobile number. `:val` is incorrect"%}'>
    </div>
    <div class="input pA5">
     <label class="addon" for="email">{%trans "Email"%}</label>
     <input type="email" name="email" id="email" placeholder='mail@example.com' maxlength='40'>
    </div>
   {%endif%}
    <div class="pA5">
     <textarea class="c txt" name="content" placeholder='{%trans "Your Message"%}' rows=4 minlength="5" maxlength="1000" data-resizable></textarea>
    </div>
    <div class="input pA5 mTB25">
     <button type="submit" name="submit-contact" class="btn block success">{%trans "Send"%}</button>
    </div>

   </form>
  </div>


  <div class="c4 s12 os bg-white pA25">
    <h3>{%trans "How to contact us"%}</h3>
    <div class="contact-data">

       <address class="vcard mB10">
        <div class="author author_name hide"><span class="fn">{%trans "jibres"%}</span></div>
        <div class="adr">
{%if lang.current =='en'%}
          <div class="extended-address">{%trans "Ermile, Floor2, Yas Building"%}</div>
          <div class="street-address">{%trans "1st alley, Haft-e-tir St"%}</div>
          <div class="locality">{%trans "Qom"%}</div>
          <div class="country-name">{%trans "Iran"%}</div>
{%else%}
          <div class="country-name">{%trans "Iran"%}</div>
          <div class="locality">{%trans "Qom"%}</div>
          <div class="street-address">{%trans "1st alley, Haft-e-tir St"%}</div>
          <div class="extended-address">{%trans "Floor2, Yas Building"%}</div>
{%endif%}
          <div class="postal-code">{%trans "Postal Code"%} {{"37196-17540" | fitNumber }}</div>
        </div>
        <div class="email ltr">info@jibres.com</div>
        <a class="tel ltr" href="tel:+982536505281">{{"(+98) 25" | fitNumber}} {{"3650 5281" | fitNumber}}</a>
        <a class="tel ltr" href="tel:+982536505460">{{"(+98) 25" | fitNumber}} {{"3650 5460" | fitNumber}}</a>
        <a class="tel ltr mT10" href="tel:+982128422590">{{"(+98) 21" | fitNumber}} {{"2842 2590" | fitNumber}}</a>
       </address>
    </div>
    <a href="https://goo.gl/maps/HUdi1YmcFBz" target="_blank" class="map" title='{%trans "Our location on map"%}'>
     <img src="{{url.static}}/images/map/ermile.png" alt="{{site.title}}">
    </a>

  </div>

 </div>
{%endblock%}
