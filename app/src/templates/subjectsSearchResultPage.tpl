{include file="head-html.tpl"}
<body>
    {include file="navbar.tpl"}
    <h1 class="text-center">Search Result</h1>
    {if $haveResults}
        {include file="subjects.tpl"}
    {else}
        <p class="alert alert-danger" role="alert">No results found.</p>
    {/if}
    {include file="footer.tpl"}
</body>