{include file="head-html.tpl"}
<body>
  {include file="header.tpl"}
  <h1 class="text-center">Carreras de la Facultad de Ciencias Exactas</h1>
 {if $errorMessage neq ""} 
  <p class="alert alert-danger" role="alert">{$errorMessage}</p>
{/if}
  {if $isLoggedIn}
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Agregar Carrera
    </button>

    <div class="collapse container" id="collapseExample">
      <form action="/careers/add" method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Nombre</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3">
          <label for="years" class="form-label">Años</label>
          <input type="number" name="years" id="years" class="form-control">
        </div>
        <div class="mb-3">
          <label for="semester" class="form-label">Facultad</label>
          <input type="text" name="faculty" id="faculty" class="form-control">
        </div>
        <button class="btn" type="submit">Enviar</button>
      </form>
    </div>
  {/if}

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Carrera</th>
        <th>Facultad</th>
        <th>Cantidad de años</th>
        {if $isLoggedIn}
          <th>Editar</th>
          <th>Borrar</th>
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
            {if $isLoggedIn}
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