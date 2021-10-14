{include file="head-html.tpl"}
<h1>Login</h1>

<form action="verifyUser" method="post">
  <input type="email" name="userEmail">
  <input type="password" name="userPassword">
  <input type="submit" value="Submit">
</form> 
{if $errorMessage neq "" }
  <h2>{$errorMessage}</h2>
{/if}