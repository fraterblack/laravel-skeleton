<?php

namespace Lpf\Applications\Panel\Http\Controllers\Users;

use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Artesaos\Defender\Contracts\Repositories\PermissionRepository;
use Artesaos\Defender\Contracts\Repositories\RoleRepository;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="admin/permissoes/funcoes-de-usuario")
 */
class RolesController extends BaseController
{
    /**
     * ACL Permission name
     * @var array
     */
    private $requiredPermissions = [ 'admin.user_roles' ];

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Funções de Usuários';

    protected $request;
    protected $roleRepository;
    function __construct(Request $request,
                         RoleRepository $roleRepository)
    {
        $this->userHasPermission($this->requiredPermissions);

        parent::__construct();

        $this->request = $request;
        $this->roleRepository = $roleRepository;

        view()->share('section', 'user_roles');
    }

    /**
     * @Get("", as="panel::user_roles.index")
     * @Post("", as="panel::user_roles.index")
     */
    public function index()
    {
        $roles = $this->roleRepository->paginate();

        return $this->view('user_roles.index', [
            "records" => $roles
        ]);
    }

    /**
     * @Get("cadastrar", as="panel::user_roles.create")
     */
    public function create()
    {
        return $this->view('user_roles.create');
    }

    /**
     * @Post("cadastrar", as="panel::user_roles.store")
     */
    public function store()
    {
        $role = $this->roleRepository->create($this->request->get('name'));

        if ($role) {
            return redirect()->route(($this->request->has('redirect_to_list')) ? 'panel::user_roles.index' : 'panel::user_roles.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    /**
     * @Get("{id}/editar", as="panel::user_roles.edit", where={"id": "[0-9]+"})
     */
    public function edit($id)
    {
        $role = $this->roleRepository->findById($id);

        return $this->view('user_roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * @Put("{id}/editar", as="panel::user_roles.update")
     */
    public function update($id)
    {
        $role = $this->roleRepository->findById($id);
        $role->name = $this->request->get('name');

        if ($role->save()) {
            return redirect()->to($this->request->input('last_url', route('panel::user_roles.index')))->with('success', 'Editado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    /**
     * @Get("{id}/excluir", as="panel::user_roles.delete", where={"id": "[0-9]+"})
     */
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

    /**
     * @Get("{id}/gerenciar-recursos", as="panel::user_roles.editPermissions", where={"id": "[0-9]+"})
     */
    public function editPermissions($id,
                                    PermissionRepository $permissionRepository)
    {
        $role = $this->roleRepository->findById($id);

        //Não permite alterar "master"
        if ($role->name == config('defender.superuser_role')) {
            app()->abort(403);
        }

        $permissions = $permissionRepository->all();

        $role->load([ 'permissions' ]);

        return $this->view('user_roles.editPermissions', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * @Put("{id}/gerenciar-recursos", as="panel::user_roles.updatePermissions", where={"id": "[0-9]+"})
     */
    public function updatePermissions($id,
                                      PermissionRepository $permissionRepository)
    {
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