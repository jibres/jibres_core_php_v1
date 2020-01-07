function registerServiceWorker()
{
  return;
  // removeAllServiceWorkers();

  if ('serviceWorker' in navigator)
  {
    if (navigator.serviceWorker.controller)
    {
      console.log("Active service worker found, no need to register.");
    }
    else
    {
      // Register the service worker
      navigator.serviceWorker.register("sw-v23.js", { scope: "./"})
      .then(function (_reg)
      {
        console.log("Service worker has been registered for scope " + _reg.scope);
      });
    }
  }
  else
  {
    logy('service worker is not supported');
  }
}

function removeAllServiceWorkers()
{
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.getRegistrations().then(function (registrations)
    {
      //returns installed service workers
      if (registrations.length)
      {
        for(let registration of registrations)
        {
          registration.unregister();
        }
      }
    });
  }
}
