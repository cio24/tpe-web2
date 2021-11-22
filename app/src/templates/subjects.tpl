{if $errorMessage neq ""} 
<p class="alert alert-danger" role="alert">{$errorMessage}</p>
{/if}
{if $admin} 
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
    <th>Career</th>
    <th>Image</th>
    {if $admin}
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
        <td>{$subject->career}</td>
        {if $subject->image_path} 
        <td><img src={$subject->image_path} /></td>
        {else}
        <td>No image</td>
        {/if}

        {if $admin}
        <td><a class="btn bi bi-pencil-square" href="/subjects/{$subject->id}/edit"></a></td>
        <td><a class="btn bi bi-trash" href="/subjects/{$subject->id}/delete"></a></td>
        {/if}
    </tr>
    {/foreach}
</tbody>
</table>
<div class="d-flex justify-content-center">

{if $pageNumber > 1}
<a class="btn btn-outline-dark mx-1" href="/subjects/page/{$pageNumber - 1}" role="button"><</a>
{/if}
<button type="button" class="btn btn-light" disabled>{$pageNumber}</button>
{if $pageNumber < $maxPageNumber}
<a class="btn btn-outline-dark mx-1" href="/subjects/page/{$pageNumber + 1}" role="button">></a>
{/if}
</div>