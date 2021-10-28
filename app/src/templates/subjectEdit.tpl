{include file="head-html.tpl"}
<body>
    {include file="header.tpl"}
    <h1 class="text-center">Editar Materia</h1>
    <form class="container" action="/subjects/{$subject[0]->id}/edit/update" method="post">
        <div class="mb-3">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" value="{$subject[0]->name}">
        </div>
        <div class="mb-3">
            <label for="year">Año</label>
            <input type="number" class="form-control" name="year" value="{$subject[0]->year}">
        </div>
        <div class="mb-3">
            <label for="semester">Cuatrimestre</label>
            <input type="number" class="form-control" name="semester" id="" value="{$subject[0]->semester}">
        </div>
        <div class="mb-3">
            <label for="direct_requirement">Correlativa</label>
            <select class="form-control" name="direct_requirement" id="">
                <option selected value="null">Sin Correlativas</option>
                {foreach from=$subjects item=$item}
                    <option value="{$item.id}">{$item.name}</option>
                {/foreach}}
            </select>
        </div>
        <div class="mb-3">
            <label for="career">Carrera</label>
            <select class="form-control" name="career" id="">
                {foreach from=$careers item=$career}
                    <option value="{$career.id}">{$career.name}</option>
                {/foreach}}
            </select>
        </div>
        <button class="btn" type="submit">Enviar</button>
    </form>
    {include file="footer.tpl"}
</body>