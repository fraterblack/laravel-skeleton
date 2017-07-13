<?php

namespace Lpf\Interfaces\Shared\Traits;

use Artesaos\Attacher\AttacherModel;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Lpf\Domains\Shared\Contracts\AttacherRepository;

trait HasAttacherTrait
{
    protected $attacherRepository;

    protected function makeAttacherRepository()
    {
        if (!$this->attacherRepository instanceof AttacherRepository) {
            $this->attacherRepository = app()->make(AttacherRepository::class);
        }
    }

    protected function getImages($model, $type = null)
    {
        if ($imageModel = $this->getImageModel($model)) {
            if ($type) {
                return $imageModel->ofType($type)->getResults();
            } else {
                return $imageModel->getResults();
            }
        }
    }

    protected function deleteImages($model, $type = null)
    {
        $this->makeAttacherRepository();

        $filesystem = app()->make(Filesystem::class);

        if ($imageModel = $this->getImageModel($model)) {
            if ($type) {
                $images = $imageModel->ofType($type)->getResults();
            } else {
                $images = $imageModel->getResults();
            }

            if ($images) {
                if ($images instanceof AttacherModel) {
                    if ($filesystem->exists('/uploads/images/' . $images->id)) {
                        $filesystem->deleteDir('/uploads/images/' . $images->id);
                    }
                    $this->attacherRepository->delete($images);
                }

                if ($images instanceof Collection) {
                    foreach ($images as $image) {
                        if (!empty($image) && $image instanceof AttacherModel) {
                            if ($filesystem->exists('/uploads/images/' . $image->id)) {
                                $filesystem->deleteDir('/uploads/images/' . $image->id);
                            }

                            $this->attacherRepository->delete($image);
                        }
                    }
                }
            }
        }
    }

    protected function addImage($model, $image, $style_guide = null, $type = null)
    {
        $this->makeAttacherRepository();

        return $this->attacherRepository->addImage($model, $image, $style_guide, $type);
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