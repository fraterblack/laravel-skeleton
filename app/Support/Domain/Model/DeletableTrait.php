<?php

namespace Lpf\Support\Domain\Model;

use Exception;

trait DeletableTrait
{
    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        if (is_null($this->getKeyName())) {
            throw new Exception('No primary key defined on model.');
        }

        if (!$this->canBeDeleted()) {
            throw new Exception('The model can not delete. Its ID is protected.');
        }

        if ($this->exists) {
            if ($this->fireModelEvent('deleting') === false) {
                return false;
            }

            // Here, we'll touch the owning models, verifying these timestamps get updated
            // for the models. This will allow any caching to get broken on the parents
            // by the timestamp. Then we will go ahead and delete the model instance.
            $this->touchOwners();

            $this->performDeleteOnModel();

            $this->exists = false;

            // Once the model has been deleted, we will fire off the deleted event so that
            // the developers may hook into post-delete operations. We will then return
            // a boolean true as the delete is presumably successful on the database.
            $this->fireModelEvent('deleted', false);

            return true;
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deletable()
    {
        return $this->canBeDeleted();
    }

    /**
     * Analyze if the model is deletable
     *
     * @return bool
     * @throws Exception
     */
    protected function canBeDeleted()
    {
        if (! property_exists($this, 'protectedIds')) {
            throw new Exception('Please set the $protectedIds (array) property to your model.');
        }

        if (in_array($this->id, $this->protectedIds)) {
            return false;
        }

        return true;
    }
}