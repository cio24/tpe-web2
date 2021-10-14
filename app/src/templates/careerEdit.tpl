{include file="head-html.tpl"}
<body>
    {include file="header.tpl"}
    <h1 class="text-center">Editar Carrera</h1>
    <form class="container" action="/careers/{$career->id}/edit/update" method="post">
        <div class="mb-3">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" value="{$career->name}">
        </div>
        <div class="mb-3">
            <label for="years">Años</label>
            <input type="number" class="form-control" name="years" id="years" value="{$career->years}">
        </div>
        <div class="mb-3">
            <label for="faculty">Facultad</label>
            <input type="text" class="form-control" name="faculty" id="faculty" value="{$career->faculty}">
        </div>
        <button class="btn" type="submit">Enviar</button>
    </form>
    {include file="footer.tpl"}
</body>