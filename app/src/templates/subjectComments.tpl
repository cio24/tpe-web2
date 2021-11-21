<section id="app" class="container" data-id="{$subjectData->id}" data-userId="{$userId}">
    <h2>Comments</h2>
    {if $loggedIn}
      <form @submit.prevent="createComment">
        <div class="row">
          <div class="col">
            <h3>Add comment</h3>
          </div>
          <div class="col">
            <label for="comment">Comment</label>
            <textarea name="comment" id="comment" v-model="comment" cols="30" rows="2"></textarea>
          </div>
          <div class="col">
            <label for="rating">Rating</label>
            <select name="rating" id="rating" v-model="difficulty">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="col">
            <button type="submit">Send</button>
          </div>
        </div>
      </form>
    {/if}
    <div v-for="comment in comments" class="row">
      <h3 class="col">{{ comment.user_id }}</h3>
      <p class="col">{{ comment.comment }} {{ comment.difficulty }}</p>
      {if $admin}
        <a class="col btn bi bi-trash" id="btn-delete" @click="deleteComment(comment.id)" :data-id="comment.id"></a>
      {/if}
    </div>
  </section>
  <script src="../js/app.js"></script>