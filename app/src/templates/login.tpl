{include file="head-html.tpl"}
<body>
  {include file="header.tpl"}
  <h1 class="text-center">Login</h1>
  <form class="container" action="verifyUser" method="post">
    <label for="userEmail">Email</label>
    <input type="email" name="userEmail" id="userEmail" class="form-control">
    <label for="userPassword">Contraseña</label>
    <input type="password" name="userPassword" id="userPassword" class="form-control">
    <input type="submit" value="Submit">
  </form> 
  {if $errorMessage neq "" }
    <p class="alert alert-danger" role="alert">{$errorMessage}</p>
  {/if}
  {include file="footer.tpl"}
</body>