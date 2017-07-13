<?php

namespace Lpf\Interfaces\Shared\Traits;

use Lpf\Support\Domain\Repository\Contracts\RetrieveExtendedRepository;

trait SlugHelpersTrait
{

    /**
     * @param RetrieveExtendedRepository $repository
     * @param string $value
     * @param null|integer $id
     * @param string $field
     * @return string
     */
    protected function generateSlug($repository, $value, $id = null, $field = 'slug')
    {
        $slug = $this->slugify($value);
        $initialSlug = $slug;

        $i = 1;
        while(!$this->validateSlug($repository, $slug, $id, $field)) {
            $slug = $initialSlug . '-' . $i;

            $i++;
        }

        return $slug;
    }

    /**
     * @param RetrieveExtendedRepository $repository
     * @param string $slug
     * @param null|integer $id
     * @param string $field
     * @return bool|\UnexpectedValueException
     */
    protected function validateSlug($repository, $slug, $id = null, $field = 'slug')
    {
        if (!$repository instanceof RetrieveExtendedRepository) {
            return new \UnexpectedValueException('The method findByField is not available in the repository');
        }

        $slugs = $repository->findByField($field, $slug, [$field, 'id']);

        if ($slugs->count() > 0) {
            if ($id) {
                if ($slugs->contains('id', $id)) {
                    return true;
                }
            }

            return false;
        }

        return true;
    }

    /**
     * @param string $slug
     * @return string
     */
    protected function slugify($slug)
    {
        return str_slug($slug);
    }
}