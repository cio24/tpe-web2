{include file="head-html.tpl"}
<body>
  {include file="navbar.tpl"}
  <h1 class="text-center">Careers of National University of Central Buenos Aires </h1>
 {if $errorMessage neq ""} 
  <p class="alert alert-danger" role="alert">{$errorMessage}</p>
{/if}
  {if $admin}
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Create career
    </button>

    <div class="collapse container" id="collapseExample">
      <form action="/careers/add" method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3">
          <label for="years" class="form-label">Years</label>
          <input type="number" name="years" id="years" class="form-control">
        </div>
        <div class="mb-3">
          <label for="semester" class="form-label">Faculty</label>
          <input type="text" name="faculty" id="faculty" class="form-control">
        </div>
        <button class="btn" type="submit">Create</button>
      </form>
    </div>
  {/if}

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Career</th>
        <th>Faculty</th>
        <th>Amount of years</th>
        {if $admin}
          <th>Edit</th>
          <th>Delete</th>
        {/if}
      </tr>
    </thead>
    <tbody>
      <tr>
        {foreach $data as $career}
          <tr>
            <td><a href="/careers/{$career->id}">{$career->name}</a></td>
            <td>{$career->faculty}</td>
            <td>{$career->years}</td>
            {if $admin}
              <td><a class="btn bi bi-pencil-square" href="/careers/{$career->id}/edit"></a></td>
              <td><a class="btn bi bi-trash" href="/careers/{$career->id}/delete"></a></td>
            {/if}
          </tr>
        {/foreach}
      </tr>
    </tbody>
  </table>
  {include file="footer.tpl"}
</body>