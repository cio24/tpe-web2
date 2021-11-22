      <div class="input-group mb-3">

        <span class="input-group-text">Sort by</span>
        
        <select v-model="sortBy" class="form-select" aria-label="Default select example">
          <option value="date" selected>date</option>
          <option value="difficulty">difficulty</option>
        </select>

        <span class="input-group-text">Order</span>

        <select v-model="order" class="form-select" aria-label="Default select example">
          <option value="asc" selected>asc</option>
          <option value="desc">desc</option>
        </select>

        <span class="input-group-text">Filter by Difficulty</span>

        <select v-model="difficultyFilterValue" class="form-select" aria-label="Default select example">
          <option value="1" selected>1</option>
          <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        </select>

        <form @submit.prevent="filterOrUpdate">
          <button class="btn btn-success">Update</button>
        </form>   
    </div>
<table class="table table-hover">
    <thead>
        <tr>
        <th>User</th>
        <th>Comment</th>
        <th>Difficulty</th>
        {if $admin}
            <th>Delete</th>
        {/if}
        </tr>
    </thead>
    <tbody>
    <tr v-for="comment in comments">
            <td>{{ comment.user_id }}</td>
            <td>{{ comment.comment }}</td>
            <td>{{ comment.difficulty}}</td>
            {if $admin}
            <td class="btn bi bi-trash" id="btn-delete" @click="deleteComment(comment.id)" :data-id="comment.id"></td>
            {/if}
        </tr>
    </tbody>
</table>