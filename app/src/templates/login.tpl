{include file="head-html.tpl"}
<body>
  {include file="header.tpl"}
  <h1 class="text-center">Login</h1>
  <form class="container" action="verifyUser" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control">
    <label for="userPassword">Contraseña</label>
    <input type="password" name="password" id="password" class="form-control">
    <input type="submit" value="Submit">
  </form> 
  {if $errorMessage neq "" }
    <p class="alert alert-danger" role="alert">{$errorMessage}</p>
  {/if}
  {include file="footer.tpl"}
</body>