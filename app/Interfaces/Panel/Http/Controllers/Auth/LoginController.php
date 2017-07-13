<?php

namespace Lpf\Interfaces\Panel\Http\Controllers\Auth;

use Lpf\Interfaces\Panel\Http\Controllers\BaseController;
use Lpf\Domains\Users\Contracts\UserRepository;
//use Lpf\Support\Services\ExternalAuth\Contracts\ExternalAuthService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var ExternalAuthService
     */
    //protected $externalAuthService;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request,
                                UserRepository $userRepository/*,
                                ExternalAuthService $externalAuthService*/
    ) {
        parent::__construct();

        $this->userRepository = $userRepository;
        //$this->externalAuthService = $externalAuthService;

        $this->middleware('guest', ['except' => ['logout', 'redirectToProvider', 'handleProviderCallback']]);

        //Se a variável redirect_to estiver setada, muda o destino de $redirectTo
        $this->redirectTo = $request->input('redirect_to', route('admin.initial'));
    }

    /**
     * Sobrescreve método da trait AuthenticatesUsers
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        $redirectTo = back()->getTargetUrl();

        if (!empty($request->session()->get('last_url'))) {
            $redirectTo = $request->session()->get('last_url');
        }

        return $this->view('panel::auth.login', [
            'redirect_to' => $redirectTo
        ]);
    }

    /**
     * Sobrescreve método da trait AuthenticatesUsers
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->route('admin.auth.getLogin')
            ->with([
                'last_url' => $request->get('redirect_to', $this->redirectTo)
            ])
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('admin.auth.postLogin');
    }

    /**
     * Redirect the user to the external authentication page.
     */
    /*public function redirectToProvider($driver, Request $request)
    {
        if (!empty($request->get('refer'))) {
            $request->session()->put('last_url', $request->get('refer'));
        }

        return $this->externalAuthService->driver($driver)->redirect();
    }*/

    /**
     * Obtain the user information from external service.
     */
    /*public function handleProviderCallback($driver, Guard $auth, Request $request)
    {
        try {
            $socialUser = $this->externalAuthService->driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->intended(route('admin.auth.getLogin'))->with([ 'error' => $e->getMessage() ]);
        }

        //Verifica se usuário já está cadastrado
        $authUser = $this->userRepository->findByField($this->socialIdColumn($driver), $socialUser->getId())->first();

        if (!$authUser) {

            //USUÁRIO LOGADO
            //Se usuário está logado, redireciona para a edição de dados da conta
            if ($auth->user()) {
                $this->userRepository->update($auth->user(), [
                    $this->socialIdColumn($driver) => $socialUser->getId()
                ]);

                return redirect()->route('account.configurations.editAccessData');
            }

            //NOVO USUÁRIO
            //Verifica se o e-mail do possível novo usuário já não está sendo usado
            if (!empty($socialUser->getEmail())
                && $this->userRepository->findByField('email', $socialUser->getEmail())->first()) {
                return redirect()->route('auth.getLogin')->with('warning', 'O e-mail da sua conta na rede social já está sendo usado.
                Se a conta existente pertence a você, faça login e depois atribua sua conta da rede social em configurações.');
            }

            //Cria um novo usuário
            if (!empty($socialUser->getId())) {
                $avatar = $socialUser->getAvatar();
                $avatar = str_replace('sz=50', 'sz=140', $avatar);

                return redirect()->route('account.create')->with([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    $this->socialIdColumn($driver) => $socialUser->getId(),
                ]);
            }
        }

        //LOGA O USUÁRIO
        $auth->login($authUser, true);

        if (!empty($request->session()->get('last_url'))) {
            $this->redirectTo = $request->session()->get('last_url');
        }

        return redirect()->intended($this->redirectTo);
    }*/

    /*protected function socialIdColumn($driver)
    {
        return $driver . '_id';
    }*/
}