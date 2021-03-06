<?php

namespace Lpf\Interfaces\Panel\Http\Controllers\Users;

use Lpf\Interfaces\Panel\Http\Controllers\BaseController;
use Lpf\Interfaces\Shared\Http\Requests\Users\StoreUserRequest;
use Lpf\Interfaces\Shared\Http\Requests\Users\UpdateUserRequest;
use Lpf\Domains\Users\Contracts\UserRepository;
use Artesaos\Defender\Contracts\Repositories\RoleRepository;
use Artesaos\Defender\Role;
use Illuminate\Http\Request;
use Lpf\Domains\Users\Events\NewUserEvent;
use Lpf\Domains\Users\Events\UpdatedUserEvent;

class UsersController extends BaseController
{
    /**
     * ACL Permission name
     * @var array|null
     */
    protected $requiredPermissions = ['admin.users'];

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
        parent::__construct();

        $this->userHasPermission();

        $this->request = $request;
        $this->userRepository = $userRepository;

        view()->share('active_menu_item', 'users.users');
    }

    public function index()
    {
        $users = $this->userRepository->index($this->request->toArray(),  ['*']);
        $users = $this->userRepository->loadModelRelations($users, [
            'roles'
        ]);

        return $this->view('panel::acl.users.index', [
            "records" => $users
        ]);
    }

    public function create(RoleRepository $roleRepository)
    {
        $roles = $roleRepository->getList('name', 'id');

        return $this->view('panel::acl.users.create', [
            'roles' => $roles
        ]);
    }

    public function store(StoreUserRequest $request, RoleRepository $roleRepository)
    {
        $newPassword = $request->get('password');

        $request->merge([ 'password' => bcrypt($request->get('password')) ]);

        $newUser = $this->userRepository->create($request->all());

        if ($newUser) {
            foreach ($request->get('roles', []) as $roleId) {
                $role = $roleRepository->findById($roleId);

                if ($role instanceof Role) {
                    $newUser->attachRole($role);
                }
            }

            event(new NewUserEvent($newUser, $newPassword));

            return redirect()->route(($request->has('redirect_to_list')) ? 'admin.users.index' : 'admin.users.create')->with('success', 'Cadastrado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    public function edit($id, RoleRepository $roleRepository)
    {
        $roles = $roleRepository->getList('name', 'id');

        $user = $this->userRepository->findByID($id);

        return $this->view('panel::acl.users.edit', [
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findByID($id);

        $newPassword = $request->get('password', null);

        if (!empty($request->get('password'))) {
            $request->merge([ 'password' => bcrypt($request->get('password')) ]);

            $attributes = $request->all();
        } else {
            $attributes = $request->except([ 'password' ]);
        }

        if ($this->userRepository->update($user, $attributes)) {
            $user->syncRoles($request->get('roles', []));

            event(new UpdatedUserEvent($user, $newPassword));

            return redirect()->to($request->input('last_url', route('admin.users.index')))->with('success', 'Editado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }

    public function delete($id)
    {
        $this->userRepository->deleteById($id);

        return back();
    }
}