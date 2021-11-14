<form class="container" action="/subjects/{$subject->id}/{$addOrUpdate}" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" name="name" value="{$subject->name}">
    </div>
    <div class="mb-3">
        <label for="year">Año</label>
        <input type="number" class="form-control" name="year" value="{$subject->year}">
    </div>
    <div class="mb-3">
        <label for="semester">Cuatrimestre</label>
        <input type="number" class="form-control" name="semester" id="" value="{$subject->semester}">
    </div>
    <div class="mb-3">
        <label for="direct_requirement">Correlativa</label>
        <select class="form-control" name="direct_requirement" id="">
            <option selected value="null">Sin Correlativas</option>
            {foreach from=$subjects item=$item}
                <option value="{$item->id}">{$item->name}</option>
            {/foreach}}
        </select>
    </div>
    <div class="mb-3">
        <label for="career">Carrera</label>
        <select class="form-control" name="career" id="">
            {foreach from=$careersData item=$career}
                <option value="{$career->id}">{$career->name}</option>
            {/foreach}}
        </select>
    </div>
            {* load image *}
    <div class="mb-3">
        <label for="image" class="form-label">Imagen</label>
        <input type="file" name="input_image" id="image"  accept="image/png, image/jpg, image/jpeg"  class="form-control"/>
    </div>
    <button class="btn" type="submit">Enviar</button>
</form>