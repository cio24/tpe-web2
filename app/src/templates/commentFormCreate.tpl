    <h3>Add comment</h3>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Comment</span>
        <input v-model="comment" type="text" class="form-control" placeholder="Hard" aria-label="Hard" aria-describedby="basic-addon1">
        <span class="input-group-text" id="basic-addon1">Difficulty</span>
        <select v-model="difficulty" class="form-select" aria-label="Default select example">
          <option value="1" selected>1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <form @submit.prevent="createComment">
          <button class="btn btn-success">Send</button>
        </form>   
    </div>