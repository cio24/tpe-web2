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