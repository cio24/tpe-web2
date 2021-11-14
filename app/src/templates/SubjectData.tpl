{include file="head-html.tpl"}
<body>
  {include file="header.tpl"}
  <h1 class="text-center">{$subjectData->name}</h1>

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
        <td>{$subjectData->year}</td>
        <td>{$subjectData->semester}</td>
        <td>{$subjectData->direct_requirement}</td>
        <td>{$subjectData->careerName}</td>
      </tr>
    </tbody>
  </table>
  {include file="footer.tpl"}
</body