<h1 class="text-center">All Subjects</h1>
{if $errorMessage neq ""} 
<p class="alert alert-danger" role="alert">{$errorMessage}</p>
{/if}
{if $logged} 
<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Create subject
</button>

<div class="collapse container" id="collapseExample">
{include file="subjectForm.tpl"}
</div>
{/if}

<table class="table table-hover">
<thead>
    <tr>
    <th>Subject</th>
    <th>Year</th>
    <th>Semester</th>
    <th>Requirement</th>
    <th>Career</th>
    <th>Image</th>
    {if $logged}
        <th>Edit</th>
        <th>Delete</th>
        
    {/if}
    </tr>
</thead>
<tbody>
    {foreach $subjectsData as $subject}
    <tr>
        <td><a href="/subjects/{$subject->id}">{$subject->name}</a></td>
        <td>{$subject->year}</td>
        <td>{$subject->semester}</td>
        <td>{$subject->direct_requirement}</td>
        <td>{$subject->career}</td>
        {if $subject->image_path} 
        <td><img src={$subject->image_path} /></td>
        {else}
        <td>No image</td>
        {/if}

        {if $logged}
        <td><a class="btn bi bi-pencil-square" href="/subjects/{$subject->id}/edit"></a></td>
        <td><a class="btn bi bi-trash" href="/subjects/{$subject->id}/delete"></a></td>
        {/if}
    </tr>
    {/foreach}
</tbody>
</table>