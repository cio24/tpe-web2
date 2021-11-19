  <h1 class="text-center">Career</h1>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Faculty</th>
        <th>Amount of years</th>
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


  <h1 class="text-center">Subjects</h1>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Subject</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Requirement</th>
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