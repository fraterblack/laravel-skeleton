<?php

namespace Lpf\Applications\Panel\Http\Controllers\Users;

use Artesaos\Defender\Contracts\Repositories\RoleRepository;
use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Artesaos\Defender\Contracts\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class PermissionsController extends BaseController
{
    /**
     * ACL Permission name
     * @var array|null
     */
    protected $requiredPermissions = ['admin.user_roles'];

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Recursos de Função';

    protected $request;
    protected $permissionRepository;

    function __construct(Request $request,
                         PermissionRepository $permissionRepository
    ) {
        parent::__construct();

        $this->userHasPermission();

        $this->request = $request;
        $this->permissionRepository = $permissionRepository;

        view()->share('section', 'acl');
        view()->share('section_item', 'user_role_permissions');
    }

    public function index()
    {
        $permissions = $this->permissionRepository->paginate();

        return $this->view('panel::acl.user_role_permissions.index', [
            "records" => $permissions
        ]);
    }

    public function create(RoleRepository $roleRepository)
    {

        return $this->view('panel::acl.user_role_permissions.create', [
            'user_roles' => $roleRepository->all()
        ]);
    }

    public function store(RoleRepository $roleRepository)
    {
        $permission = $this->permissionRepository->create($this->request->get('name'), $this->request->get('readable_name'));

        if ($permission) {
            foreach ($this->request->get('sync_permission_with', []) as $roleId) {
                $role = $roleRepository->findById($roleId);

                if ($role) {
                    $role->attachPermission([$permission->id]);
                }
            }

            return redirect()->route(($this->request->has('redirect_to_list')) ? 'admin.user_role_permissions.index' : 'admin.user_role_permissions.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    public function delete($id)
    {
        $permission = $this->permissionRepository->findById($id);

        //Permissões "master" e "admin" não podem ser excluídas
        if ($permission->name == config('defender.superuser_role') || $permission->name == "admin") {
            app()->abort(403);
        }

        $permission->delete();

        return back();
    }
}