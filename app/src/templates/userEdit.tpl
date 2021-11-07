{include file="head-html.tpl"}
<body>
    {include file="header.tpl"}
    <h1 class="text-center">Editar Usuario</h1>
    <form class="container" action="/users/{$user->email}/update" method="post">
        <div class="mb-3">
            <h2 class="text-center">{$user->email}</h2>
        </div>
        <div class="mb-3">
            <label for="permission">Permisos</label>
            <select class="form-control" name="permission" id="permission">
                <option value="standard">standard</option>
                <option value="admin">admin</option>
            </select>
        </div>
        <button class="btn" type="submit">Enviar</button>
    </form>
    {include file="footer.tpl"}
</body>