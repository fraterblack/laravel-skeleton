<?php

namespace Lpf\Applications\Panel\Http\Controllers\Users;

use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Artesaos\Defender\Contracts\Repositories\PermissionRepository;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="admin/permissoes/recursos-de-funcao")
 */
class PermissionsController extends BaseController
{
    /**
     * ACL Permission name
     * @var array
     */
    private $requiredPermissions = [ 'admin.user_role_permissions' ];

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Recursos de Função';

    protected $request;
    protected $permissionRepository;

    function __construct(Request $request,
                         PermissionRepository $permissionRepository)
    {
        $this->userHasPermission($this->requiredPermissions);

        parent::__construct();

        $this->request = $request;
        $this->permissionRepository = $permissionRepository;

        view()->share('section', 'user_role_permissions');
    }

    /**
     * @Get("", as="panel::user_role_permissions.index")
     * @Post("", as="panel::user_role_permissions.index")
     */
    public function index()
    {
        $permissions = $this->permissionRepository->paginate();

        return $this->view('user_role_permissions.index', [
            "records" => $permissions
        ]);
    }

    /**
     * @Get("cadastrar", as="panel::user_role_permissions.create")
     */
    public function create()
    {
        return $this->view('user_role_permissions.create');
    }

    /**
     * @Post("cadastrar", as="panel::user_role_permissions.store")
     */
    public function store()
    {
        $permission = $this->permissionRepository->create($this->request->get('name'), $this->request->get('readable_name'));

        if ($permission) {
            return redirect()->route(($this->request->has('redirect_to_list')) ? 'panel::user_role_permissions.index' : 'panel::user_role_permissions.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    /**
     * @Get("{id}/excluir", as="panel::user_role_permissions.delete", where={"id": "[0-9]+"})
     */
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