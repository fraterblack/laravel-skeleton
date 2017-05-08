<?php

namespace Lpf\Applications\Panel\Http\Controllers\Users;

use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Artesaos\Defender\Contracts\Repositories\PermissionRepository;
use Artesaos\Defender\Contracts\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RolesController extends BaseController
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
    protected $pageName = 'Funções de Usuários';

    protected $request;
    protected $roleRepository;
    function __construct(Request $request,
                         RoleRepository $roleRepository
    ) {

        parent::__construct();
        $this->userHasPermission($this->requiredPermissions);

        $this->request = $request;
        $this->roleRepository = $roleRepository;

        view()->share('section', 'acl');
        view()->share('section_item', 'user_roles');
    }

    public function index()
    {
        $roles = $this->roleRepository->paginate();

        return $this->view('panel::acl.user_roles.index', [
            "records" => $roles
        ]);
    }

    public function create()
    {
        return $this->view('panel::acl.user_roles.create');
    }

    public function store()
    {
        $role = $this->roleRepository->create($this->request->get('name'));

        if ($role) {
            return redirect()->route(($this->request->has('redirect_to_list')) ? 'admin.user_roles.index' : 'admin.user_roles.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    public function edit($id)
    {
        $role = $this->roleRepository->findById($id);

        return $this->view('panel::acl.user_roles.edit', [
            'role' => $role
        ]);
    }

    public function update($id)
    {
        $role = $this->roleRepository->findById($id);
        $role->name = $this->request->get('name');

        if ($role->save()) {
            return redirect()->to($this->request->input('last_url', route('admin.user_roles.index')))->with('success', 'Editado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    public function delete($id)
    {
        $role = $this->roleRepository->findById($id);

        //Função "master" não pode ser excluída
        if ($role->name == config('defender.superuser_role')) {
            app()->abort(403);
        }

        $role->delete();

        return back();
    }

    public function editPermissions($id,
                                    PermissionRepository $permissionRepository
    ) {
        $role = $this->roleRepository->findById($id);

        //Não permite alterar "master"
        if ($role->name == config('defender.superuser_role')) {
            app()->abort(403);
        }

        $permissions = $permissionRepository->all();

        $role->load(['permissions']);

        return $this->view('panel::acl.user_roles.editPermissions', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function updatePermissions($id,
                                      PermissionRepository $permissionRepository
    ) {
        $role = $this->roleRepository->findById($id);

        if ($role) {
            //Não permite alterar "master"
            if ($role->name == config('defender.superuser_role')) {
                app()->abort(403);
            }

            $adminPermission = $permissionRepository->findByName('admin');

            $role->syncPermissions(array_merge($this->request->get('selected_permission', []), [ $adminPermission->id ]));
        }

        return back();
    }
}