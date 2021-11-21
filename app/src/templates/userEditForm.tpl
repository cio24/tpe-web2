<h1 class="text-center">Edit user</h1>
<form class="container" action="/users/{$user->email}/update" method="post">
    <div class="mb-3">
        <h2 class="text-center">{$user->email}</h2>
    </div>
    <div class="mb-3">
        <label for="permission">Permissions</label>
        <select class="form-control" name="permission" id="permission">
            <option value="0">standard</option>
            <option value="1">admin</option>
        </select>
    </div>
    <button class="btn" type="submit">Submit</button>
</form>