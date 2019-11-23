// Morede estefade baraye kar ba HTML5 History

(function(root)
{
  "use strict";

  var $window  = $(window);
  var defaults =
  {
    html: '',
    title: null,
    url: '/',
    replace: false,
    filter: null,
    fake: false,
    data: false,
    nostate: false,
    abort: true,
    ajax:
    {
      type: 'get'
    }
  };

  // add ajax poll to allow to cancel ajax requests before sending new one
  $.xhrPool = [];
  $.xhrPool.abortAll = function()
  {
     $(this).each(function(idx, jqXHR)
     {
        jqXHR.abort();
     });
     $.xhrPool.length = 0
  };

  $.ajaxSetup(
  {
    beforeSend: function(jqXHR)
    {
        $.xhrPool.push(jqXHR);
    },
    complete: function(jqXHR)
    {
       var index = $.xhrPool.indexOf(jqXHR);
       if (index > -1)
       {
          $.xhrPool.splice(index, 1);
       }
    }
 });


  function render(obj)
  {
    var focusBeforeChange         = $(':focus');
    var pageContentChanged        = null;
    var needHardRefreshOnEmptyNew = true;

    $window.trigger('navigate:render:start', obj);
    // try to remove tippy from view
    beforePushStateSiftal();
    if(!obj.url)
    {
      obj.url = '/';
    }

    var html = obj.html.trim();
    if(html.indexOf('data-xhr') === false)
    {
      // hard redirect to this address or change all html
      location.replace(obj.url);
      return;
    }
    if(obj.content && $('body').attr('data-in') !== obj.content)
    {
      if($('body').hasClass('siftal') && obj.siftal)
      {
        // body has class siftal, dont worry, continue
      }
      else
      {
        // hard redirect to new content
        location.replace(obj.url);
        return;
      }
    }

    var $html = $(html);


    if(obj.page === '')
    {
      obj.page = 'home';
    }
    if(obj.page)
    {
      $('body').attr('data-page', obj.page);
    }
    // set content on each request
    $('body').attr('data-in', obj.content);
    // set theme
    $('body').attr('data-theme', obj.theme);
    // set subdomain on body
    $('body').attr('data-subdomain', obj.subdomain);

    $window.trigger('navigate:render:filter:before', obj.filter);

    var filter = _.isArray(obj.filter) ?
        '[data-xhr="' + obj.filter.join('"], [data-xhr="') + '"]'
      : obj.filter ? '[data-xhr="' + obj.filter + '"]' : null;

    (filter ? $html.filter(filter).add($html.find(filter)) : $html).each(function()
    {
      var myNewXhrName = $(this).attr('data-xhr');
      // if we find new element with xhr
      if(myNewXhrName)
      {
        needHardRefreshOnEmptyNew = false;
        var $targetOnOldPage      = $('[data-xhr="' + myNewXhrName + '"]');
        if($targetOnOldPage.length > 0)
        {
          // if we find new element is existing elements


          // if new content is different from current content replace it
          // its added by javad, if has bug report this condition
          if($(this).html() !== $targetOnOldPage.html())
          {
            pageContentChanged = true;
            // add content after old one - simple replace
            $targetOnOldPage.after(this);
            // remove old one
            $targetOnOldPage.remove();
          }

        }
      }
    });

    if(needHardRefreshOnEmptyNew)
    {
      // hard refresh to new location because new is not have xhr element
      location.replace(obj.url);
      // need check if new is have something do this, else do nothing
      // need more time to check conditions!
    }

    // new check if html is not exist, do hard refresh
    if(html)
    {
      // if html contain doctype or head tag, need to hard refresh
      if(html.indexOf("<!DOCTYPE html>") === 0 || html.indexOf("<head>") > 0)
      {
        location.replace(obj.url);
      }
    }

    $window.trigger('navigate:render:filter:done', filter);

    var $title = $html.find('title');

    if($title.length)
    {
      $('head title').text($title.text());
    }

    if(obj.js)
    {
      var scripts = obj.js;
      $window.trigger('navigate:render:scripts:before', obj.js);

      scripts.forEach(function(src)
      {
        var $script = $('script[src="' + src + '"]');

        if(!$script.length)
        {
          $script = $('<script></script>');
          $script.prop('async', true);
          $script.prop('src', src);
          $window.trigger('navigate:render:script:created', $script);

          $(document.body).append($script);

          $window.trigger('navigate:render:script:appended', $script);
        }
      });
      $window.trigger('navigate:render:scripts:done');
    }

    // on navigate if in new page we have autofocus field, set focus to it
    if(!pageContentChanged)
    {
      // if page content is not changed, do nothing...
      // logy(10);
      console.log('page is not changed, need hard redirect');
      // location.replace(obj.url);
    }
    // if we have input with autofocus, set focus to first of it
    else if($('input[autofocus]').length)
    {
      // logy(20);
      if(focusBeforeChange.is($('input[autofocus]')[0]))
      {
        // if this and old input is equal skip
        // check later
        // logy(21);
      }
      else
      {
        var myNewInput = $('input[autofocus]')[0];
        if(myNewInput)
        {
          $(myNewInput).trigger("focus");
        }
        // logy(24);
      }
    }
    else
    {
      // we dont have autofocus input, skip it
      // logy(30);
    }
    // set page new title if exit
    if(obj.title)
    {
      document.title = obj.title;
    }


    // call pushState function if exist
    callFunc('pushStateSiftal', false);

    $window.trigger('navigate:render:done');
  }


  function fetch(props, md5)
  {
    $window.trigger('navigate:fetch:start', props, md5);
    // add loading
    $(document.body).addClass('loading-page');
    callFunc('loading_page', true);

    var options = $.extend(true, {}, props.ajax,
    {
      url: props.url,
      // headers: { 'Cached-MD5': props.md5 }
    });

    var deferred = new jQuery.Deferred();

    if(props.abort)
    {
      $.xhrPool.abortAll();
    }

    // add progress to navigates
    options.beforeSend = function()
    {
      NProgress.start();
      NProgress.inc();
    };
    options.complete = function(jqXHR)
    {
      if(jqXHR.responseJSON && jqXHR.responseJSON.ok === true && jqXHR.responseJSON.redirect)
      {
        // do nothing because we have another navigate
      }
      else
      {
        NProgress.done(true);
      }
    };

    // set timeout for fetch page
    options.timeout = 30000;




    var myXhr = $.ajax(options)
    .done(function(res)
    {
      $window.trigger('navigate:fetch:ajax:start', options);

      // redirect it's okay and we have redirect
      if(res.ok === true && res.redirect)
      {
        Navigate(
        {
          url: res.redirect
        });
        return;
      }

      var json, html;

      var jsonExpected = res[0] === '{';
      try
      {
        var n        = res.indexOf('\n');
        n            = n === -1 ? undefined : n;
        json         = JSON.parse(res.slice(0, n));

        if(json && json.debug)
        {
          notifGenerator(json.debug);
        }

        // if(json.getFromCache) {
          // json = LS.get(props.md5);
        // } else {
          html = res.slice(n);
          // if(json.md5) {
            // LS.set(props.url, json.md5);
            // LS.set(json.md5, _.extend(json, {html: html}));
            _.extend(json, {html: html});
          // }
        // }

        if(json.options)
        {
          var $options = $('#options-meta');
          $options.putData(json.options);
        }
      }
      catch(e) {
        if (jsonExpected)
        {
          notif('error', 'There was an error in parsing JSON!');
        }
        deferred.reject();
        return location.replace(props.url);
      }

      $window.trigger('navigate:fetch:ajax:done', json)
             .trigger('navigate:fetch:done', json);
      deferred.resolve(json);
      // remove loading
      setTimeout (function()
      {
        $(document.body).removeClass('loading-page');
      }, 500);
      callFunc('loading_page', false);

    })
    .fail(function(_result, _textStatus, _error)
    {
      if(_textStatus === 'timeout')
      {
        notif('fatal', 'Failed from timeout', 'Request failed', 5000, {'position':'topCenter', 'icon':'sf-hourglass-o'});
        pingi();
      }
      if(_textStatus === 'error' && _result.readyState == 0 && _error == "")
      {
        // probably network is failed like internet connection
        console.log("Network error detected");
        // check with pingi
        pingi();
      }


      if(_result && _result.responseJSON)
      {
        notifGenerator(_result.responseJSON);
      }

      // remove loading
      setTimeout (function()
      {
        $(document.body).removeClass('loading-page');
      }, 500);
      callFunc('loading_page', false);

      $window.trigger('navigate:fetch:ajax:error', _result, _textStatus, _error);
    });

    return deferred.promise();
  }

  function Navigate(obj)
  {
    // logy(obj);
    var deferred = new jQuery.Deferred();
    var props    = $.extend(true, {}, defaults, obj);

    $window.trigger('navigate:start', props);

    if(obj.fake)
    {
      deferred.resolve();
      if(!obj.nostate)
      {
        root.history[props.replace ? 'replaceState' : 'pushState'](props, props.title, props.url);
      }
      $window.trigger('statechange');

      return deferred.promise();
    }

    if(obj.html)
    {
      render(props);
      deferred.resolve();
      if(!obj.nostate)
      {
        root.history[props.replace ? 'replaceState' : 'pushState'](props, props.title, props.url);
      }
      $window.trigger('statechange');

      return deferred.promise();
    }

    var md5 = LS.get(props.url);
    props.md5 = md5;
    fetch(props).then(function(data)
    {
      _.extend(props, data);

      if(!obj.nostate)
      {
        root.history[props.replace ? 'replaceState' : 'pushState'](props, props.title, props.url);
      }
      if(!props.data)
      {
        render(_.extend({}, props, {html: data.html}));
      }

      $window.trigger('statechange');

      deferred.resolve(props);
    });

    return deferred.promise();
  }

  window.onpopstate = function(e)
  {
    var state = e.state;

    if(!state) return true;
    e.preventDefault();

    if(!state.html)
    {
      // logy(state);
      fetch(state).then(function(data)
      {
        var props = _.extend(true, {}, state, data.json);

        render(_.extend({}, props, {html: data.html}));

        $window.trigger('statechange');
      });
    }
    else
    {
      render(state);
      $window.trigger('statechange');
    }

    return false;
  };

  if(!history.state)
  {
    Navigate(
    {
      url: location.href,
      fake: true,
      replace: true
    });
  }

  root.Navigate = Navigate;
})(this);