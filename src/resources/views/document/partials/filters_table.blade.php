<form id="image-storage-search-form">
<table class="table  table-hover table-bordered " id="sort_t">
    <thead>
    <tr>
        <th width="25%">{{__cms("Название")}}</th>
        <th width="10%">{{__cms("Создана (от)")}}</th>
        <th width="10%">{{__cms("Создана (до)")}}</th>
        <th width="10%">{{__cms("Связанные теги")}}</th>
        <th width="1%">
            <div class="smart-form pull-right">
                <div class="input input-file image-storage-images">
                    <span class="button">
                        <input type="file" name="files[]" multiple="multiple"  id="upload-image-storage-input" onchange="ImageStorage.uploadFiles(this);">
                        {{__cms("Выбрать")}}
                    </span>
                    <input type="text" class="j-image-title" placeholder="{{__cms("Загрузить документ")}}">
                </div>
            </div>
        </th>
    </tr>
    <tr class="image-storage-filters-row">
        <td>
            <div class="relative">
                <input type="text"
                       value="{{Session::get('image_storage_filter.document.filterByTitle')}}"
                       name="image_storage_filter[filterByTitle]"
                       class="form-control input-small">
            </div>
        </td>
        <td>
            <div>
                <input type="text"
                       id="f-datepicker-from"
                       value="{{Session::get('image_storage_filter.document.filterByDate.from')}}"
                       name="image_storage_filter[filterByDate][from]"
                       class="form-control input-small datepicker" >
                <span class="input-group-addon form-input-icon form-input-filter-icon">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </td>
        <td>
            <div>
                <input type="text"
                       id="f-datepicker-to"
                       value="{{Session::get('image_storage_filter.document.filterByDate.to')}}"
                       name="image_storage_filter[filterByDate][to]"
                       class="form-control input-small datepicker" >
                <span class="input-group-addon form-input-icon form-input-filter-icon">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </td>
        <td>
            <select name="image_storage_filter[filterByTags][]" multiple="multiple" class="image-storage-select">
                @foreach($relatedEntities['tags'] as $tag)
                    <option value="{{$tag->id}}"
                            {{in_array($tag->id,Session::get('image_storage_filter.document.filterByTags', [])) ? "selected" : ""}}>
                        {{$tag->title}}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <button class="btn btn-default btn-sm image-storage-button"
                    type="button"
                    onclick="ImageStorage.doSearch();">
                {{__cms('Поиск') }}
            </button>
            <button class="btn btn-default btn-sm image-storage-button"
                    type="button"
                    onclick="ImageStorage.doResetFilters();">
                {{__cms('Сбросить') }}
            </button>
        </td>
    </tr>
    </thead>
</table>
</form>
