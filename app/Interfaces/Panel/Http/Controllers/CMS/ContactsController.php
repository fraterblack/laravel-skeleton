<?php

namespace Lpf\Interfaces\Panel\Http\Controllers\CMS;

use Illuminate\Http\Request;
use Lpf\Interfaces\Shared\Traits\IndexMethodsTrait;
use Lpf\Interfaces\Panel\Http\Controllers\BaseController;
use Lpf\Domains\CMS\Contracts\ContactRecipientRepository;
use Lpf\Domains\CMS\Contracts\ContactRepository;

class ContactsController extends BaseController
{
    use IndexMethodsTrait;

    /**
     * ACL Permission name
     * @var array|null
     */
    protected $requiredPermissions = ['admin.contacts'];

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Contatos';

    protected $request;
    protected $contactRecipientRepository;
    protected $contactRepository;

    public function __construct(Request $request,
                                ContactRecipientRepository $contactRecipientRepository,
                                ContactRepository $contactRepository
    ) {
        parent::__construct();

        $this->userHasPermission();

        $this->request = $request;
        $this->contactRecipientRepository = $contactRecipientRepository;
        $this->contactRepository = $contactRepository;

        view()->share('section', 'cms');
        view()->share('section_item', 'contacts');
    }

    public function index()
    {
        $contacts = $this->contactRepository->index($this->request, ['*']);

        $contacts = $this->contactRepository->loadModelRelations($contacts, [
            'recipient'
        ]);

        $this->createIndexFilter('Destinatário', 'contact_recipient_id', '=', false, $this->contactRecipientRepository->lists('name', 'id')->toArray());

        return $this->view('panel::cms.contacts.index', [
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

        return $this->view('panel::cms.contacts.show', [
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