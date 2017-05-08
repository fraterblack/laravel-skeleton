<?php

namespace Lpf\Applications\Panel\Http\Controllers\CMS;

use Illuminate\Http\Request;
use Lpf\Applications\Infrastructure\Http\Requests\CMS\StoreBannerPlaceRequest;
use Lpf\Applications\Infrastructure\Traits\HasAttacherTrait;
use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Lpf\Domains\CMS\Contracts\BannerPlaceRepository;

class BannerPlacesController extends BaseController
{
    use HasAttacherTrait;

    protected $request;
    protected $bannerPlaceRepository;

    public function __construct(Request $request,
                                BannerPlaceRepository $bannerPlaceRepository
    ) {
        parent::__construct();

        $this->request = $request;
        $this->bannerPlaceRepository = $bannerPlaceRepository;

        $this->setSeo(['title' => 'Banners']);

        view()->share('section', 'configurations');
        view()->share('section_item', 'bannerPlaces');
    }

    public function index()
    {
        $bannerPlaces = $this->bannerPlaceRepository->index($this->request, ['id', 'name', 'width', 'height', 'active', 'created_at']);

        return $this->view('panel::cms.bannerPlaces.index', [
            "records" => $bannerPlaces]);
    }

    public function create()
    {
        return $this->view('panel::cms.bannerPlaces.create', [
            'types' => $this->bannerPlaceRepository->getAvailableTypes()
        ]);
    }

    public function store(StoreBannerPlaceRequest $request)
    {
        $place = $this->bannerPlaceRepository->create($request->all());

        if ($place) {
            if ($request->file('image_map')) {
                $this->addImage($place, $request->file('image_map'), 'default');
            }

            return redirect()->route(($request->has('redirect_to_list')) ? 'admin.bannerPlaces.index' : 'admin.bannerPlaces.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->with('error', 'Houve um erro!');
    }

    public function edit($id)
    {
        $place = $this->bannerPlaceRepository->findByID($id);

        return $this->view('panel::cms.bannerPlaces.edit', [
            'place' => $place,
            'types' => $this->bannerPlaceRepository->getAvailableTypes()
        ]);
    }

    public function update($id, StoreBannerPlaceRequest $request)
    {
        $place = $this->bannerPlaceRepository->findByID($id);

        if ($this->bannerPlaceRepository->update($place, $request->all())) {
            if ($request->file('image_map')) {
                $this->deleteImages($place);

                $this->addImage($place, $request->file('image_map'), 'default');
            }

            return redirect()->to($request->input('last_url', route('admin.bannerPlaces.index')))->with('success', 'Editado com sucesso!');
        }

        return back()->with('error', 'Houve um erro!');
    }

    public function delete($id)
    {
        $place = $this->bannerPlaceRepository->findByID($id);

        $this->deleteImages($place);

        $this->bannerPlaceRepository->deleteById($id);

        return back();
    }

    public function activate($id)
    {
        $place = $this->bannerPlaceRepository->findByID($id);

        $this->bannerPlaceRepository->update($place, ['active' => true]);

        return back();
    }

    public function deactivate($id)
    {
        $place = $this->bannerPlaceRepository->findByID($id);

        $this->bannerPlaceRepository->update($place, ['active' => false]);

        return back();
    }
}