<?php

namespace Lpf\Applications\Panel\Http\Controllers\Users;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Lpf\Applications\Panel\Http\Controllers\BaseController;
use Lpf\Domains\Users\Contracts\UserRepository;
use Lpf\Support\Algolia\Events\ModelDeletedEvent;
use Lpf\Support\Algolia\Events\ModelSavedEvent;

class UsersController extends BaseController
{
    protected $request;
    protected $userRepository;

    protected $acceptedRoles = [ 'admin', 'moderator' ];

    function __construct(Request $request,
                         UserRepository $userRepository
    ) {
        parent::__construct();

        $this->request = $request;
        $this->userRepository = $userRepository;

        $this->setSeo([ 'title' => 'Usuários' ]);
        view()->share('section', 'users');
        view()->share('section_item', 'index');
    }

    public function index()
    {
        $users = $this->userRepository->index($this->request,  ['id', 'name', 'active', 'created_at']);

        return $this->view('panel::general.users.index', [
            "records" => $users
        ]);
    }

    public function delete($id, Application $app)
    {
        $user = $this->userRepository->findByID($id);

        if ($id == 1) { //Não permite que usuário 1 (super) seja excluído
            $app->abort(403);
        }

        $this->userRepository->deleteById($id);

        //Dispara Index Model Event
        event(new ModelDeletedEvent($user));

        return back();
    }

    public function find($id)
    {
        $user = $this->userRepository->findByID($id);

        $user = $this->userRepository->loadModelRelations($user, [
            'addresses.city.state'
        ]);

        return $user;
    }

    public function search($output, $query = null)
    {
        $id = $this->request->get('id'); //Consulta por ID
        $query = (!$query) ? $this->request->get('query') : $query; //Consulta por palavra-chave

        if (!empty($id) || !empty($query)) {
            if (!empty($id)) {
                $user = $this->userRepository->findByID($id, [
                    (($output == 'json') ? 'name' : 'id') . ' AS value',
                    'name',
                    'id'
                ]);

                if ($user) {
                    $user = $this->userRepository->loadModelRelations($user, [
                        'images'
                    ]);
                }

                $users = collect([ $user ]);
            } else {
                $users = $this->userRepository->search($query, [
                    (($output == 'json') ? 'name' : 'id') . ' AS value',
                    'name',
                    'id'
                ]);

                $users = $this->userRepository->loadModelRelations($users, [
                    'images'
                ]);
            }

            //Prepara a coleção
            foreach ($users as $user) {
                $user->thumb = $user->present()->avatar()['image'];
                unset($user->images);

                $user->name = $user->present()->displayName();
            }

            if ($output == "json") {
                return [
                    "success" => true,
                    "results" => $users
                ];
            }

            return $users;
        }

        //Nada passado como query
        if ($output == "json") {
            return [
                "success" => true,
                "results" => []
            ];
        }
    }
}