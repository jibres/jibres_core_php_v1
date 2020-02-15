
<li>
  <ul>
    <li><a href="{{url.here}}/backup">{% trans "Backup" %}</a></li>
    <li><a href="{{url.here}}/dbtables">{% trans "Raw table" %}</a></li>

    <li><a href="{{url.here}}/time">{% trans "Date and time" %}</a></li>
    <li><a href="{{url.here}}/info">{% trans "Server information" %}</a></li>
    <li><a href="{{url.here}}/cronjob">{% trans "Cronjob" %}</a></li>
    <li><a href="{{url.here}}/ip">{% trans "IP" %}</a></li>

    <li><a href="{{url.here}}/gitstatus">{% trans "Git status" %}</a></li>
    <li><a href="{{url.here}}/nano">{% trans "Nano" %}</a></li>
    <li><a href="{{url.here}}/update" data-shortkey="85+80" data-shortkey-timeout='500'>{% trans "Update" %}<kbd class="floatLa mRa10 fs08">up</kbd></a></li>

    <li><a href="{{url.here}}/log">{% trans "Log" %}</a></li>
    <li><a href="{{url.here}}/apilog">{% trans "Api Log" %}</a></li>
    <li><a href="{{url.here}}/smsclient">{% trans "Sms client" %}</a></li>
    {%if url.tld == 'local'%}
    <li><a href="{{url.here}}/permission">{% trans "Permission" %}</a></li>
    <li><a href="{{url.here}}/translation">{% trans "Translation tools" %}</a></li>
    {%endif%}
    <li><a href="{{url.here}}/tg" data-shortkey="84+71" data-shortkey-timeout='500'>{% trans "Telegram" %}<kbd class="floatLa mRa10 fs08">tg</kbd></a></li>

  </ul>
</li>

