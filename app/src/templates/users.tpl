<table class="table table-hover">
    <thead>
        <tr>
            <th>Email</th>
            <th>Permissions</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        {foreach $users as $user}
            <tr>
                <td>{$user->email}</td>
                <td>{$user->permission}</td>
                <td><a class="btn bi bi-pencil-square" href="/users/{$user->id}/edit"></a></td>
                <td><a class="btn bi bi-trash" href="/users/{$user->id}/delete"></a></td>
            </tr>
        {/foreach}
    </tbody>
</table>