<form action="/subjects/search" method="post">
  <div class="container">
    <h1 class="text-center">Search Subjects</h1>
    <div class="mb-3">
      <label for="subject-name-input" class="form-label">Subject name</label>
      <input name="s.name" type="text" class="form-control" placeholder="programación" id="subject-name-input" aria-describedby="subject-name-input">
    </div>
    <div class="mb-3">
      <label for="career-name-input" class="form-label">Career name</label>
      <input name="c.name" type="text" class="form-control" placeholder="ingenieria" id="career-name-input" aria-describedby="career-name-input">
    </div>
    <div class="mb-3">
      <label for="year-input" class="form-label">Year</label>
      <input name="s.year" type="number" min="1" max="5" placeholder="1" class="form-control" id="year-input">
    </div>
    <div class="mb-3">
      <label for="semester-input" class="form-label">Semester</label>
      <input name="s.semester" type="number" min="1" max="2" placeholder="2" class="form-control" id="semester-input">
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
  </div>
</form> 