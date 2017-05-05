<?php

namespace Lpf\Domains\CMS\Presenters;

use Lpf\Support\ViewPresenter\Presenter;
use Lpf\Support\ViewPresenter\TimestampsPresenterTrait;

class ContactPresenter extends Presenter
{
    use TimestampsPresenterTrait;

    public function availableSubject()
    {
        if ($this->subject) {
            return $this->subject;
        }

        return str_limit($this->message, 50);
    }

    public function dataToShow()
    {
        $attributes = $this->entity->attributesToArray();
        $visibles = $this->entity->getVisible();

        $sortedAttributes = array_map(function($i) use ($attributes) {
            return $attributes[$i];
        }, $visibles);

        $mappedAttributes = [];
        array_walk($sortedAttributes, function ($item, $key) use (&$mappedAttributes, $visibles) {
            $mappedAttributes[$visibles[$key]] = $item;
        });

        $parsedData = [];
        foreach ($mappedAttributes as $key => $value) {

            $collection = collect();
            $collection->name = trans('contact.' . $key);
            $collection->value = $this->parseData($key, $value);

            $parsedData[] = $collection;
        }

        return $parsedData;
    }

    protected function parseData($key, $value)
    {
        switch ($key) {
            case 'sent':
            case 'replied':
                return ($value == 1) ? 'Sim' : 'Não';
                break;
            case 'message':
                return nl2br($value);
                break;
            case 'created_at':
                return $this->creationDate('d/m/Y \à\s H:i \H\s');
                break;
            case 'user_id':
                return $this->user ? $this->user->present()->displayName() : 'Não logado';
                break;
            case 'contact_recipient_id':
                return $this->recipient->name;
                break;
            default:
                return $value;
                break;
        }
    }
}