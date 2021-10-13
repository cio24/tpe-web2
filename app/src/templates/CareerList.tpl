{include file="head-html.tpl"}
    <h1>Carreras de la Facultad de Ciencias Exactas</h1>


{if $isLogged}
<a class="btn btn-primary" href="careers/create" role="button">Add new</a>
{/if}

<table class="table table-hover">
  <thead>
    <tr>
        <th>Carrera</th>
        <th>Facultad</th>
        <th>Cantidad de años</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        {foreach from=$data item=$career}
            <tr>
            
                <td><a href="/careers/{$career.id}">{$career.name}</a></td>
                <td>{$career.faculty}</td>
                <td>{$career.years}</td>
            </tr>
        {/foreach}
    </tr>
  </tbody>
</table>

