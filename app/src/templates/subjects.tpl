{include file="head-html.tpl"}

<h1 style="text-align:center">Materias de la Facultad de Ciencias Exactas</h1>

<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Agregar Materia
</button>

<div class="collapse container" id="collapseExample">
  <form action="/subjects/add" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Año</label>
            <input type="number" name="year" id="year" class="form-control">
        </div>
        <div class="mb-3">
            <label for="semester" class="form-label">Cuatrimestre</label>
            <input type="number" name="semester" id="semester" class="form-control">
        </div>
        <div class="mb-3">
            <label for="direct_requirement" class="form-label">Correlativa</label>
            <select name="direct_requirement" id="direct_requirement" class="form-control">
                <option selected value="null">Sin Correlativas</option>
                {foreach from=$subjectsData item=$subject}
                  <option value="{$subject->id}">{$subject->name}</option>
                {/foreach}}
            </select>
        </div>
        <div class="mb-3">
            <label for="career" class="form-label">Carrera</label>
            <select name="career" id="career" class="form-control">
                {foreach from=$careersData item=$career}
                  <option value="{$career->id}">{$career->name}</option>
                {/foreach}}
            </select>
        </div>
        <button class="btn" type="submit">Enviar</button>
  </form>
</div>


<table class="table table-hover">
  <thead>
    <tr>
        <th>Materia</th>
        <th>Año</th>
        <th>Cuatrimestre</th>
        <th>Correlativa</th>
        <th>Carrera</th>
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

                <td><a class="btn bi bi-pencil-square" href="/subjects/{$subject->id}/edit"></a></td>
                <td><a class="btn bi bi-trash" href="/subjects/{$subject->id}/delete"></a></td>

            </tr>
        {/foreach}
  </tbody>
</table>
{include file="footer-html.tpl"}