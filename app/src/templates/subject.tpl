<h1 class="text-center">{$subjectData->name}</h1>
<table class="table table-hover">
    <thead>
        <tr>
        <th>Year</th>
        <th>Semester</th>
        <th>Requirement</th>
        <th>Career</th>
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