<div class="box">
 <header data-kerkere='#requests' data-kerkere-icon='open'><h2><?php echo T_("Requests"); ?></h2></header>

 <div class="body" id="requests">

   <p><?php echo T_("Any tool that is fluent in HTTP can communicate with the API simply by requesting the correct URI."); ?> <?php echo T_("Requests should be made using the HTTPS protocol so that traffic is encrypted."); ?> <?php echo T_("The interface responds to different methods depending on the action required."); ?></p>

   <div class="tblBox">
    <table class="tbl1 v6">
     <thead>
      <tr>
       <th><?php echo T_("Method"); ?></th>
       <th><?php echo T_("Usage"); ?></th>
      </tr>
     </thead>
     <tbody>
      <tr>
       <th>GET</th>
       <td>
        <p><?php echo T_("For simple retrieval of information about your something you should use the GET method."); ?> <?php echo T_("The information you request will be returned to you as a JSON object."); ?></p>

        <p><?php echo T_("The attributes defined by the JSON object can be used to form additional requests."); ?> <?php echo T_("Any request using the GET method is read-only and will not affect any of the objects you are querying."); ?></p>
       </td>
      </tr>

      <tr>
       <th>POST</th>
       <td>
        <p><?php echo T_("To create a new object, your request should specify the POST method."); ?></p>

        <p><?php echo T_("The POST request includes all of the attributes necessary to create a new object."); ?> <?php echo T_("When you wish to create a new object, send a POST request to the target endpoint."); ?></p>
       </td>
      </tr>

      <tr>
       <th>DELETE</th>
       <td>
        <p><?php echo T_("To destroy a resource and remove it from your account and environment, the DELETE method should be used."); ?> <?php echo T_("This will remove the specified object if it is found."); ?> <?php echo T_("If it is not found, the operation will return a response indicating that the object was not found."); ?></p>

        <p><?php echo T_("This idempotency means that you do not have to check for a resource's availability prior to issuing a delete command, the final state will be the same regardless of its existence."); ?></p>
       </td>
      </tr>

      <tr>
       <th>PUT</th>
       <td>
        <p><?php echo T_("To update the information about a resource in your account, the PUT method is available."); ?></p>

        <p><?php echo T_("Like the DELETE Method, the PUT method is idempotent."); ?> <?php echo T_("It sets the state of the target using the provided values, regardless of their current values."); ?> <?php echo T_("Requests using the PUT method do not need to check the current attributes of the object."); ?></p>
       </td>
      </tr>

      <tr>
       <th>PATCH</th>
       <td>
        <p><?php echo T_("To update a portion of the information about a resource in your account, the PATCH method is available."); ?></p>

        <p><?php echo T_("Like the PUT Method, the PATCH method is idempotent."); ?></p>
       </td>
      </tr>

      <tr>
       <th>HEAD</th>
       <td>
        <p><?php echo T_("Finally, to retrieve metadata information, you should use the HEAD method to get the headers."); ?> <?php echo T_("This returns only the header of what would be returned with an associated GET request."); ?></p>

        <p><?php echo T_("Response headers contain some useful information about your API access and the results that are available for your request."); ?></p>

        <p><?php echo T_("For instance, the headers contain your current rate-limit value and the amount of time available until the limit resets."); ?> <?php echo T_("It also contains metrics about the total number of objects found, pagination information, and the total content length."); ?></p>
       </td>
      </tr>

     </tbody>
    </table>

  </div>
 </div>

</div>

