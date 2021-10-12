{include file="head-html.tpl"}
<h1 style="text-align:center">{$subjectData.name}</h1>

<table class="table table-hover">
  <thead>
        <tr>
            <th>Año</th>
            <th>Cuatrimestre</th>
            <th>Correlativa</th>
            <th>Carrera</th>
        </tr>
  </thead>
  <tbody>
        <tr>
            <td>{$subjectData.year}</td>
            <td>{$subjectData.semester}</td>
            <td>{$subjectData.direct_requirement}</td>
            <td>{$subjectData.careerName}</td>
        </tr>
  </tbody>
</table>