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
      </tr>
    </thead>
    <tbody>
      {foreach $subjectsDataOfCareer as $subjectData}
        <tr>
          <td><a href="/subjects/{$subjectData->id}">{$subjectData->name}</a></td>
          <td>{$subjectData->year}</td>
          <td>{$subjectData->semester}</td>
        </tr>
      {/foreach}
    </tbody>
  </table>