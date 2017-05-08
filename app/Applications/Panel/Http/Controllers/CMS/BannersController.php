<?php

namespace Lpf\Applications\Panel\Http\Controllers\CMS;

use Illuminate\Http\Request;
use Lpf\Applications\Infrastructure\Http\Requests\CMS\StoreBannerRequest;
use Lpf\Applications\Infrastructure\Http\Requests\CMS\UpdateBannerRequest;
use Lpf\Applications\Infrastructure\Traits\HasAttacherTrait;
use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Lpf\Domains\CMS\BannerPlace;
use Lpf\Domains\CMS\Contracts\BannerPlaceRepository;
use Lpf\Domains\CMS\Contracts\BannerRepository;

class BannersController extends BaseController
{
    use HasAttacherTrait;

    protected $request;
    protected $bannerPlaceRepository;
    protected $bannerRepository;

    public function __construct(Request $request,
                                BannerPlaceRepository $bannerPlaceRepository,
                                BannerRepository $bannerRepository
    ) {
        parent::__construct();

        $this->request = $request;
        $this->bannerPlaceRepository = $bannerPlaceRepository;
        $this->bannerRepository = $bannerRepository;

        $this->setSeo(['title' => 'Banners']);

        view()->share('section', 'cms');
        view()->share('section_item', 'banners');
    }

    public function index()
    {
        $banners = $this->bannerRepository->index($this->request, ['*']);

        $banners = $this->bannerRepository->loadModelRelations($banners, [
            'place'
        ]);

        return $this->view('panel::cms.banners.index', [
            "records" => $banners
        ]);
    }

    public function create()
    {
        return $this->view('panel::cms.banners.create', [
            'places' => $this->bannerPlaceRepository->getAll(['*'], false, false),
            'types' => $this->bannerPlaceRepository->getAvailableTypes()
        ]);
    }

    public function store(StoreBannerRequest $request)
    {
        $banner = $this->bannerRepository->create($request->all());

        if ($banner) {
            if ($request->file('image')) {
                $this->attachImage($banner, $request);
            }

            return redirect()->route(($request->has('redirect_to_list')) ? 'admin.banners.index' : 'admin.banners.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->with('error', 'Houve um erro!');
    }

    public function edit($id)
    {
        $banner = $this->bannerRepository->findByID($id);

        return $this->view('panel::cms.banners.edit', [
            'banner' => $banner,
            'places' => $this->bannerPlaceRepository->getAll(['*'], false, false),
            'types' => $this->bannerPlaceRepository->getAvailableTypes()
        ]);
    }

    public function update($id, UpdateBannerRequest $request)
    {
        $banner = $this->bannerRepository->findByID($id);

        if ($this->bannerRepository->update($banner, $request->all())) {
            if ($request->file('image')) {
                $this->deleteImages($banner);

                $this->attachImage($banner, $request);
            }

            return redirect()->to($request->input('last_url', route('admin.banners.index')))->with('success', 'Editado com sucesso!');
        }

        return back()->with('error', 'Houve um erro!');
    }

    public function delete($id)
    {
        $banner = $this->bannerRepository->findByID($id);

        $this->deleteImages($banner);

        $this->bannerRepository->deleteById($id);

        return back();
    }

    public function activate($id)
    {
        $banner = $this->bannerRepository->findByID($id);

        $this->bannerRepository->update($banner, ['active' => true]);

        return back();
    }

    public function deactivate($id)
    {
        $banner = $this->bannerRepository->findByID($id);

        $this->bannerRepository->update($banner, ['active' => false]);

        return back();
    }

    protected function attachImage($banner, $request)
    {
        $bannerPlace = $this->bannerPlaceRepository->findByID($request->get('banner_place_id'));

        if ($banner->type == BannerPlace::TYPE_IMAGE) {
            $this->addImage($banner, $request->file('image'), [
                'banner' => [
                    'normal' => function ($image) use ($bannerPlace) {
                        $image->fit($bannerPlace->width, $bannerPlace->height);
                        return $image;
                    }
                ]
            ]);
        } elseif ($banner->type == BannerPlace::TYPE_GIF) {
            $this->addImage($banner, $request->file('image'), [
                'banner' => [
                    'normal' => function ($image) use ($bannerPlace) {
                        $image->fit($bannerPlace->width, $bannerPlace->height);
                        return $image;
                    }
                ]
            ]);

            $request->file('image')->storeAs(
                'uploads/images/' . $banner->image->id . '/normal', $banner->image->file_name
            );
        }
    }
}