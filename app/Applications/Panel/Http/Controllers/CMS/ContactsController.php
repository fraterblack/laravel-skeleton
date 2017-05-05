<?php

namespace Lpf\Applications\Panel\Http\Controllers\CMS;

use Illuminate\Http\Request;
use Lpf\Applications\Infrastructure\Traits\IndexMethodsTrait;
use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Lpf\Domains\CMS\Contracts\ContactRecipientRepository;
use Lpf\Domains\CMS\Contracts\ContactRepository;

class ContactsController extends BaseController
{
    use IndexMethodsTrait;

    protected $request;
    protected $contactRecipientRepository;
    protected $contactRepository;

    public function __construct(Request $request,
                                ContactRecipientRepository $contactRecipientRepository,
                                ContactRepository $contactRepository
    ) {
        parent::__construct();

        $this->request = $request;
        $this->contactRecipientRepository = $contactRecipientRepository;
        $this->contactRepository = $contactRepository;

        $this->setSeo(['title' => 'Contato']);

        view()->share('section', 'cms');
        view()->share('section_item', 'contacts');
    }

    public function index()
    {
        $contacts = $this->contactRepository->index($this->request, ['*']);

        $contacts = $this->contactRepository->loadModelRelations($contacts, [
            'recipient'
        ]);

        $this->createIndexFilter('Destinatário', 'contact_recipient_id', '=', true, $this->contactRecipientRepository->lists('name', 'id')->toArray());

        return $this->view('panel::general.contacts.index', [
            "records" => $contacts,
            'filters' => $this->getIndexFilters()
        ]);
    }

    public function show($id)
    {
        $contact = $this->contactRepository->findByID($id);

        $contact = $this->contactRepository->loadModelRelations($contact, [
            'recipient'
        ]);

        return $this->view('panel::general.contacts.show', [
            'contact' => $contact
        ]);
    }

    public function delete($id)
    {
        $contact = $this->contactRepository->findByID($id);

        $this->contactRepository->deleteById($id);

        return back();
    }

    public function markAsReplied($id)
    {
        $contact = $this->contactRepository->findByID($id);

        $this->contactRepository->update($contact, ['replied' => true]);

        return back();
    }

    public function unmarkAsReplied($id)
    {
        $contact = $this->contactRepository->findByID($id);

        $this->contactRepository->update($contact, ['replied' => false]);

        return back();
    }
}