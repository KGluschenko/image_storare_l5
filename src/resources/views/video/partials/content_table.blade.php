<div class="superbox image-storage-container images-container col-sm-12 image-storage-selectable">
    @foreach ($data as $entity)
        @include('image-storage::video.partials.single_list')
    @endforeach
</div>