<?php

namespace Lpf\Interfaces\Panel\Http\Controllers\Users;

use Illuminate\Http\Request;
use Lpf\Interfaces\Shared\Http\Requests\Users\UpdateMyAccountRequest;
use Lpf\Interfaces\Panel\Http\Controllers\BaseController;
use Lpf\Domains\Users\Contracts\UserRepository;

class MyAccountController extends BaseController
{
    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Minha Conta';

    protected $request;
    protected $userRepository;

    function __construct(Request $request,
                         UserRepository $userRepository)
    {
        parent::__construct();

        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function edit()
    {
        $user = $this->request->user();

        return $this->view('panel::acl.my_account.edit', [
            'user' => $user
        ]);
    }

    public function update(UpdateMyAccountRequest $request)
    {
        $user = $this->request->user();

        if (!empty($request->get('password'))) {
            $request->merge([ 'password' => bcrypt($request->get('password')) ]);

            $attributes = $request->all();
        } else {
            $attributes = $request->except([ 'password' ]);
        }

        if ($this->userRepository->update($user, $attributes)) {
            return redirect()->route('admin.myAccount.edit')->with('success', 'Editado com sucesso!');
        }

        return back()->withInput()->with('error', 'Houve um erro!');
    }
}