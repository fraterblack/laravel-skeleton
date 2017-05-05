<?php

namespace Lpf\Domains\Shared\Repositories;

use Artesaos\Attacher\AttacherModel;
use Illuminate\Database\Eloquent\Model;
use Lpf\Domains\Shared\Contracts\AttacherRepository as AttacherRepositoryContract;
use Lpf\Support\Domain\Repository\Repository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttacherRepository extends Repository implements AttacherRepositoryContract
{
    /**
     * Model class for repo.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelClass = AttacherModel::class;

    /**
     * @param UploadedFile $image
     * @param string|array $styleGuide
     *
     * @return AttacherModel
     */
    public function addImage(Model $model, UploadedFile $image, $styleGuide = null, $type = null)
    {
        $instance = $this->createImageModel();
        $instance->setupFile($image, $styleGuide, $type);

        $this->getImageModel($model)->save($instance);

        return $instance;
    }

    /**
     * @return AttacherModel
     */
    protected function createImageModel()
    {
        return app()->make($this->modelClass);
    }

    protected function getImageModel($model)
    {
        if (method_exists($model, 'images')) {
            return $model->images();
        } elseif (method_exists($model, 'image')) {
            return $model->image();
        }

        return null;
    }
}