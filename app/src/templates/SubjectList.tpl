{include file="head-html.tpl"}

<h1 style="text-align:center">Materias de la Facultad de Ciencias Exactas</h1>

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
    <tr>
        {foreach from=$data item=$subject}
            <tr>
                <td><a href="/subjects/{$subject.id}">{$subject.name}</a></td>
                <td>{$subject.year}</td>
                <td>{$subject.semester}</td>
                <td>{$subject.direct_requirement}</td>
                <td>{$subject.career}</td>
            </tr>
        {/foreach}
    </tr>
  </tbody>
</table>