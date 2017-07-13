<?php

namespace Lpf\Interfaces\Panel\Http\Controllers\CMS;

use Illuminate\Http\Request;
use Lpf\Interfaces\Shared\Http\Requests\CMS\StoreBannerRequest;
use Lpf\Interfaces\Shared\Http\Requests\CMS\UpdateBannerRequest;
use Lpf\Interfaces\Shared\Traits\HasAttacherTrait;
use Lpf\Interfaces\Shared\Traits\IndexMethodsTrait;
use Lpf\Interfaces\Panel\Http\Controllers\BaseController;
use Lpf\Domains\CMS\BannerPlace;
use Lpf\Domains\CMS\Contracts\BannerPlaceRepository;
use Lpf\Domains\CMS\Contracts\BannerRepository;

class BannersController extends BaseController
{
    use HasAttacherTrait, IndexMethodsTrait;

    /**
     * ACL Permission name
     * @var array|null
     */
    protected $requiredPermissions = ['admin.banners'];

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Banners';

    protected $request;
    protected $bannerPlaceRepository;
    protected $bannerRepository;

    public function __construct(Request $request,
                                BannerPlaceRepository $bannerPlaceRepository,
                                BannerRepository $bannerRepository
    ) {
        parent::__construct();

        $this->userHasPermission();

        $this->request = $request;
        $this->bannerPlaceRepository = $bannerPlaceRepository;
        $this->bannerRepository = $bannerRepository;

        view()->share('section', 'cms');
        view()->share('section_item', 'banners');
    }

    public function index()
    {
        $banners = $this->bannerRepository->index($this->request->toArray(), ['*']);

        $banners = $this->bannerRepository->loadModelRelations($banners, [
            'place'
        ]);

        $this->createIndexFilter('Localização', 'banner_place_id', '=', false, $this->bannerPlaceRepository->dataForSelect()->toArray());

        return $this->view('panel::cms.banners.index', [
            "records" => $banners,
            'filters' => $this->getIndexFilters()
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

        if ($request->file('image')) {
            $this->deleteImages($banner);

            $this->attachImage($banner, $request);

            //Força o update do model
            $request->merge([
                'name' => $banner->name . ' '
            ]);
        }

        if ($this->bannerRepository->update($banner, $request->all())) {
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
                        if ($bannerPlace->width <= 0) {
                            $image->heighten($bannerPlace->height);
                        } elseif ($bannerPlace->height <= 0) {
                            $image->widen($bannerPlace->width);
                        } else {
                            $image->fit($bannerPlace->width, $bannerPlace->height);
                        }

                        return $image;
                    }
                ]
            ]);
        } elseif ($banner->type == BannerPlace::TYPE_GIF) {
            //Quando do tipo GIF, as dimensões usadas serão as definidas como padrão. Uma vez que a image será sobrescrita
            $this->addImage($banner, $request->file('image'), 'banner');

            $request->file('image')->storeAs(
                'uploads/images/' . $banner->image->id . '/normal', $banner->image->file_name
            );
        }
    }
}