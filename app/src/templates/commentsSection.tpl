<section id="app" class="container" data-id={$subjectData->id} data-user_id={$userId}>
  <br>
  <p v-if="message" class="alert alert-danger" role="alert">{{ message }}</p>

  {if $loggedIn}
    {include file="commentFormCreate.tpl"}
  {/if}
  <h2 class="text-center">Comments</h2>
  {include file="comments.tpl"}
</section>
<script src="../js/app.js"></script>