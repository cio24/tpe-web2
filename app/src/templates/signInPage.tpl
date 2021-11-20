{include file="head-html.tpl"}
<body>
  {include file="navbar.tpl"}
  <h1 class="text-center">Sign in</h1>
  <form class="container" action="verifyUser" method="post">
  {include file="signInAndUpFormBody.tpl"}
  </form> 
  {if $errorMessage neq "" }
    <p class="alert alert-danger" role="alert">{$errorMessage}</p>
  {/if}
  {include file="footer.tpl"}
</body>