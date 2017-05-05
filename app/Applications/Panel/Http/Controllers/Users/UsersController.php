<?php

namespace Lpf\Applications\Panel\Http\Controllers\Users;

use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Lpf\Applications\Infrastructure\Http\Requests\Users\StoreUserRequest;
use Lpf\Applications\Infrastructure\Http\Requests\Users\UpdateUserRequest;
use Lpf\Domains\Users\Contracts\UserRepository;
use Artesaos\Defender\Contracts\Repositories\RoleRepository;
use Artesaos\Defender\Role;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="admin/usuarios")
 */
class UsersController extends BaseController
{
    /**
     * ACL Permission name
     * @var array
     */
    private $requiredPermissions = [ 'admin.users' ];

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Usuários';

    protected $request;
    protected $userRepository;

    function __construct(Request $request,
                         UserRepository $userRepository)
    {
        $this->userHasPermission($this->requiredPermissions);

        parent::__construct();

        $this->request = $request;
        $this->userRepository = $userRepository;

        view()->share('section', 'users');
    }

    /**
     * @Get("", as="panel::users.index")
     * @Post("", as="panel::users.index")
     */
    public function index()
    {
        $users = $this->userRepository->index($this->request,  ['id', 'name', 'active', 'created_at']);
        $users = $this->userRepository->loadModelRelations($users, [
            'roles'
        ]);

        return $this->view('panel::acl.users.index', [
            "records" => $users
        ]);
    }

    /**
     * @Get("cadastrar", as="panel::users.create")
     */
    public function create(RoleRepository $roleRepository)
    {
        $roles = $roleRepository->getList('name', 'id');

        return $this->view('users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * @Post("cadastrar", as="panel::users.store")
     */
    public function store(StoreUserRequest $request, RoleRepository $roleRepository)
    {
        $request->merge([ 'password' => bcrypt($request->get('password')) ]);

        $newUser = $this->userRepository->create($request->all());

        if ($newUser) {
            foreach ($request->get('roles', []) as $roleId) {
                $role = $roleRepository->findById($roleId);

                if ($role instanceof Role) {
                    $newUser->attachRole($role);
                }
            }

            return redirect()->route(($request->has('redirect_to_list')) ? 'panel::users.index' : 'panel::users.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    /**
     * @Get("{id}/editar", as="panel::users.edit", where={"id": "[0-9]+"})
     */
    public function edit($id, RoleRepository $roleRepository)
    {
        $roles = $roleRepository->getList('name', 'id');

        $user = $this->userRepository->findByID($id);

        return $this->view('users.edit', [
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * @Put("{id}/editar", as="panel::users.update")
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findByID($id);

        if (!empty($request->get('password'))) {
            $request->merge([ 'password' => bcrypt($request->get('password')) ]);

            $attributes = $request->all();
        } else {
            $attributes = $request->except([ 'password' ]);
        }

        if ($this->userRepository->update($user, $attributes)) {
            return redirect()->to($request->input('last_url', route('panel::users.index')))->with('success', 'Editado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    /**
     * @Get("{id}/excluir", as="panel::users.delete", where={"id": "[0-9]+"})
     */
    public function delete($id)
    {
        if ($id == 1) { //Não permite que usuário 1 (webmaster) seja excluído
            app()->abort(403);
        }

        $this->userRepository->deleteById($id);

        return back();
    }
}