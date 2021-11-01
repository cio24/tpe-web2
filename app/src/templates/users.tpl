{include file="head-html.tpl"}
<body>
    {include file="header.tpl"}
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Email</th>
                <th>Permisos</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            {foreach $users as $user}
                <tr>
                    <td>{$user->email}</td>
                    <td>{$user->permission}</td>
                    <td><a class="btn bi bi-pencil-square" href="/users/{$user->email}/edit"></a></td>
                    <td><a class="btn bi bi-trash" href="/users/{$user->email}/delete"></a></td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    {include file="footer.tpl"}
</body>