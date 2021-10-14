{include file="head-html.tpl"}
<body>
<form action="/subjects/{$subject[0]->id}/edit/send" method="post">
            <div>
                <label for="name">Nombre</label>
                <input type="text" name="name" value="{$subject[0]->name}">
            </div>
            <div>
                <label for="year">Año</label>
                <input type="number" name="year" value="{$subject[0]->year}">
            </div>
            <div>
                <label for="semester">Cuatrimestre</label>
                <input type="number" name="semester" id="" value="{$subject[0]->semester}">
            </div>
            <div>
                <label for="direct_requirement">Correlativa</label>
                <select name="direct_requirement" id="">
                    <option selected value="null">Sin Correlativas</option>
                    {foreach from=$subjects item=$item}
                      <option value="{$item.id}">{$item.name}</option>
                    {/foreach}}
                </select>
            </div>
            <div>
                <label for="career">Carrera</label>
                <select name="career" id="">
                    {foreach from=$careers item=$career}
                      <option value="{$career.id}">{$career.name}</option>
                    {/foreach}}
                </select>
            </div>
            <button class="btn" type="submit">Enviar</button>
      </form>
</body>