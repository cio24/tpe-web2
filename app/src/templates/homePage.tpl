{include file="head-html.tpl" }
<body>
    {include file="navbar.tpl"}
    <h1 class="text-center">Careers Path</h1>
    {if $errorMessage neq "" }
        <p class="alert alert-danger" role="alert">{$errorMessage}</p>
    {/if}
    {include file="footer.tpl"}
</body>