<form class="container" action="/subjects/{$subject->id}/{$addOrUpdate}" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value="{$subject->name}">
    </div>
    <div class="mb-3">
        <label for="year">Year</label>
        <input type="number" class="form-control" name="year" value="{$subject->year}">
    </div>
    <div class="mb-3">
        <label for="semester">Semester</label>
        <input type="number" class="form-control" name="semester" id="" value="{$subject->semester}">
    </div>
    <div class="mb-3">
        <label for="direct_requirement">Requirement</label>
        <select class="form-control" name="direct_requirement" id="">
            <option selected value="null">Without requirement</option>
            {foreach from=$subjects item=$item}
                <option value="{$item->id}">{$item->name}</option>
            {/foreach}}
        </select>
    </div>
    <div class="mb-3">
        <label for="career">Career</label>
        <select class="form-control" name="career" id="">
            {foreach from=$careersData item=$career}
                <option value="{$career->id}">{$career->name}</option>
            {/foreach}}
        </select>
    </div>
            {* load image *}
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="input_image" id="image"  accept="image/png, image/jpg, image/jpeg"  class="form-control"/>
    </div>
    <button class="btn" type="submit">Submit</button>
</form>