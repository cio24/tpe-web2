{include file="head-html.tpl"}
<body>
    {include file="navbar.tpl"}
    <h1 class="text-center">Edit Career</h1>
    <form class="container" action="/careers/{$career->id}/update" method="post">
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{$career->name}">
        </div>
        <div class="mb-3">
            <label for="years">Years</label>
            <input type="number" class="form-control" name="years" id="years" value="{$career->years}">
        </div>
        <div class="mb-3">
            <label for="faculty">Faculty</label>
            <input type="text" class="form-control" name="faculty" id="faculty" value="{$career->faculty}">
        </div>
        <button class="btn" type="submit">Edit</button>
    </form>
    {include file="footer.tpl"}
</body>