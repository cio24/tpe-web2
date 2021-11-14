{include file="head-html.tpl"}
<body>
  {include file="header.tpl"}
  <h1 class="text-center">Materias de la Facultad de Ciencias Exactas</h1>
  {if $errorMessage neq ""} 
    <p class="alert alert-danger" role="alert">{$errorMessage}</p>
  {/if}
  {if $logged} 
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Agregar Materia
    </button>

    <div class="collapse container" id="collapseExample">
    {include file="subjectForm.tpl"}
    </div>
  {/if}

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Materia</th>
        <th>Año</th>
        <th>Cuatrimestre</th>
        <th>Correlativa</th>
        <th>Carrera</th>
        <th>Imagen</th>
        {if $logged}
          <th>Editar</th>
          <th>Borrar</th>
          
        {/if}
      </tr>
    </thead>
    <tbody>
      {foreach $subjectsData as $subject}
        <tr>
          <td><a href="/subjects/{$subject->id}">{$subject->name}</a></td>
          <td>{$subject->year}</td>
          <td>{$subject->semester}</td>
          <td>{$subject->direct_requirement}</td>
          <td>{$subject->career}</td>
          {if $subject->image_path} 
            <td><img src={$subject->image_path} /></td>
          {else}
            <td>Sin imagen</td>
          {/if}

          {if $logged}
            <td><a class="btn bi bi-pencil-square" href="/subjects/{$subject->id}/edit"></a></td>
            <td><a class="btn bi bi-trash" href="/subjects/{$subject->id}/delete"></a></td>
          {/if}
        </tr>
      {/foreach}
    </tbody>
  </table>
  {include file="footer.tpl"}
</body>