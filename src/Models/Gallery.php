<?php namespace Vis\ImageStorage;

use Illuminate\Database\Eloquent\Builder;

class Gallery extends AbstractImageStorageGallery
{
    protected $table = 'vis_galleries';
    protected $configPrefix = 'gallery';

    public function images()
    {
        return $this
            ->belongsToMany('Vis\ImageStorage\Image', 'vis_images2galleries', 'id_gallery', 'id_image')
            ->orderBy('priority', 'desc')
            ->withPivot('is_preview');
    }

    public function scopeHasImages(Builder $query)
    {
        return $query->has('images');
    }

    public function scopeHasActiveImages(Builder $query)
    {
        return $query->whereHas('images', function (Builder $query) {
            $query->active();
        });
    }

    private function getGalleryCurrentPreview()
    {
        return $this->images()->wherePivot("is_preview", "1")->first();
    }

    public function getGalleryPreviewImage($size = 'cms_preview')
    {
        $preview = $this->getGalleryCurrentPreview() ?: $this->images()->first();

        return $preview ? $preview->getSource($size) : '/packages/vis/image-storage/img/no_image.png';
    }
    
    public function setPreview($preview)
    {
        if ($currentPreview = $this->getGalleryCurrentPreview()) {
            $this->images()->updateExistingPivot($currentPreview->id, ["is_preview" => 0]);
        }

        $this->images()->updateExistingPivot($preview, ["is_preview" => 1]);
        $this->flushCacheRelation($this->images()->getRelated());
    }

    public function changeGalleryOrder($idArray)
    {
        $priority = count($idArray);

        foreach ($idArray as $id) {
            $this->images()->updateExistingPivot($id, ['priority' => $priority]);
            $priority--;
        }

        $this->flushCacheRelation($this->images()->getRelated());
    }

    public function deleteToGalleryRelation($id)
    {
        $this->images()->detach($id);
        $this->flushCacheRelation($this->images()->getRelated());
    }

    public function relateToGallery($idArray)
    {
        $this->images()->syncWithoutDetaching($idArray);
        $this->flushCacheRelation($this->images()->getRelated());
    }

}
