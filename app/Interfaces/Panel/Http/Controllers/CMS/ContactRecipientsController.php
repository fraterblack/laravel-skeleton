<?php

namespace Lpf\Interfaces\Panel\Http\Controllers\CMS;

use Illuminate\Http\Request;
use Lpf\Interfaces\Shared\Http\Requests\CMS\StoreContactRecipientRequest;
use Lpf\Interfaces\Panel\Http\Controllers\BaseController;
use Lpf\Domains\CMS\Contracts\ContactRecipientRepository;

class ContactRecipientsController extends BaseController
{
    /**
     * ACL Permission name
     * @var array|null
     */
    protected $requiredPermissions = ['admin.contact.recipients'];

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Destinatários de Contato';

    protected $request;
    protected $contactRecipientRepository;

    public function __construct(Request $request,
                                ContactRecipientRepository $contactRecipientRepository
    ) {
        parent::__construct();

        $this->userHasPermission();

        $this->request = $request;
        $this->contactRecipientRepository = $contactRecipientRepository;

        view()->share('section', 'configurations');
        view()->share('section_item', 'contactRecipients');
    }

    public function index()
    {
        $contactRecipients = $this->contactRecipientRepository->index($this->request->toArray(), ['id', 'name', 'email', 'active', 'created_at']);

        return $this->view('panel::cms.contactRecipients.index', [
            "records" => $contactRecipients]);
    }

    public function create()
    {
        return $this->view('panel::cms.contactRecipients.create');
    }

    public function store(StoreContactRecipientRequest $request)
    {
        $recipient = $this->contactRecipientRepository->create($request->all());

        if ($recipient) {
            return redirect()->route(($request->has('redirect_to_list')) ? 'admin.contactRecipients.index' : 'admin.contactRecipients.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->with('error', 'Houve um erro!');
    }

    public function edit($id)
    {
        $recipient = $this->contactRecipientRepository->findByID($id);

        return $this->view('panel::cms.contactRecipients.edit', [
            'recipient' => $recipient
        ]);
    }

    public function update($id, StoreContactRecipientRequest $request)
    {
        $recipient = $this->contactRecipientRepository->findByID($id);

        if ($this->contactRecipientRepository->update($recipient, $request->all())) {
            return redirect()->to($request->input('last_url', route('admin.contactRecipients.index')))->with('success', 'Editado com sucesso!');
        }

        return back()->with('error', 'Houve um erro!');
    }

    public function delete($id)
    {
        $this->contactRecipientRepository->deleteById($id);

        return back();
    }

    public function activate($id)
    {
        $recipient = $this->contactRecipientRepository->findByID($id);

        $this->contactRecipientRepository->update($recipient, ['active' => true]);

        return back();
    }

    public function deactivate($id)
    {
        $recipient = $this->contactRecipientRepository->findByID($id);

        $this->contactRecipientRepository->update($recipient, ['active' => false]);

        return back();
    }
}