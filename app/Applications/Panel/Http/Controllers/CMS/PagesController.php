<?php

namespace Lpf\Applications\Panel\Http\Controllers\CMS;

use Illuminate\Http\Request;
use Lpf\Applications\Infrastructure\Http\Requests\CMS\StorePageRequest;
use Lpf\Applications\Infrastructure\Traits\SlugHelpersTrait;
use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Lpf\Domains\CMS\Contracts\PageRepository;

class PagesController extends BaseController
{
    use SlugHelpersTrait;

    protected $request;
    protected $pageRepository;

    public function __construct(Request $request,
                                PageRepository $pageRepository
    ) {
        parent::__construct();

        $this->request = $request;
        $this->pageRepository = $pageRepository;

        $this->setSeo([ 'title' => 'Páginas' ]);

        view()->share('section', 'cms');
        view()->share('section_item', 'pages');
    }

    public function index()
    {
        $pages = $this->pageRepository->index($this->request, [ 'id', 'title', 'slug', 'active', 'created_at' ]);

        return $this->view('panel::cms.pages.index', [
            "records" => $pages
        ]);
    }

    public function create()
    {
        return $this->view('panel::cms.pages.create');
    }

    public function store(StorePageRequest $request)
    {
        $request->merge([
            'slug' => $request->has('slug')
                ? $this->generateSlug($this->pageRepository, $request->get('slug'))
                : $this->generateSlug($this->pageRepository, $request->get('title'))
        ]);

        $page = $this->pageRepository->create($request->all());

        if ($page) {
            return redirect()->route(($request->has('redirect_to_list')) ? 'admin.pages.index' : 'admin.pages.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->with('error', 'Houve um erro!');
    }

    public function edit($id)
    {
        $page = $this->pageRepository->findByID($id);

        return $this->view('panel::cms.pages.edit', [ 'page' => $page ]);
    }

    public function update($id, StorePageRequest $request)
    {
        $page = $this->pageRepository->findByID($id);

        $request->merge([
            'slug' => $request->has('slug')
                ? $this->generateSlug($this->pageRepository, $request->get('slug'), $id)
                : $this->generateSlug($this->pageRepository, $request->get('title'), $id)
        ]);

        if ($this->pageRepository->update($page, $request->all())) {

            return redirect()->to($request->input('last_url', route('admin.pages.index')))->with('success', 'Editado com sucesso!');
        }

        return back()->with('error', 'Houve um erro!');
    }

    public function delete($id)
    {
        $this->pageRepository->deleteById($id);

        return back();
    }

    public function activate($id)
    {
        $page = $this->pageRepository->findByID($id);

        $this->pageRepository->update($page, [ 'active' => true ]);

        return back();
    }

    public function deactivate($id)
    {
        $page = $this->pageRepository->findByID($id);

        $this->pageRepository->update($page, [ 'active' => false ]);

        return back();
    }
}