{include file="head-html.tpl"}
<body>
  {include file="header.tpl"}
  <h1 class="text-center">Carrera</h1>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Facultad</th>
        <th>Cantidad de años</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{$careerData->name}</td>
        <td>{$careerData->faculty}</td>
        <td>{$careerData->years}</td>
      </tr>
    </tbody>
  </table>


  <h1 style="text-align:center">Materias</h1>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Materia</th>
        <th>Año</th>
        <th>Cuatrimestre</th>
        <th>Correlativa</th>
      </tr>
    </thead>
    <tbody>
      {foreach $subjectsDataOfCareer as $subjectData}
        <tr>
          <td>{$subjectData->name}</td>
          <td>{$subjectData->year}</td>
          <td>{$subjectData->semester}</td>
          <td>{$subjectData->direct_requirement}</td>
        </tr>
      {/foreach}
    </tbody>
  </table>
  {include file="footer.tpl"}
</body>