<?php

namespace Lpf\Applications\Panel\Http\Controllers\General;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Lpf\Applications\Panel\Http\Controllers\BaseController;

class CacheController extends BaseController
{
    /**
     * ACL Permission name
     * @var array|null
     */
    protected $requiredPermissions = ['admin.general.settings'];

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Controle de Cache - Configurações';

    protected $request;
    protected $app;

    function __construct(Request $request, Application $app)
    {
        parent::__construct();

        $this->userHasPermission();

        $this->request = $request;
        $this->app = $app;

        view()->share('section', 'configurations');
        view()->share('section_item', 'cacheControl');
    }

    public function cacheControl()
    {
        if ($this->request->has('command')) {
            $command = null;
            $result = null;

            try {
                switch ($this->request->get('command')) {
                    //Class Loader
                    case 'optimize':
                        $command = 'Otimizar Class Loader - php artisan optimize --force';

                        $result = Artisan::call('optimize', [
                            '--force' => true,
                        ]);
                        break;
                    case 'clear_compiled':
                        $command = 'Otimizar Class Loader - php artisan clear-compiled';

                        $result = Artisan::call('clear-compiled', []);
                        break;

                    //Config
                    case 'config_cache':
                        $command = 'Cache de Configurações - php artisan config:cache';

                        $result = Artisan::call('config:cache', []);
                        break;
                    case 'config_clear':
                        $command = 'Limpar Cache de Configurações - php artisan config:clear';

                        $result = Artisan::call('config:clear', []);
                        break;

                    //Routes
                    case 'route_cache':
                        $command = 'Cache de Rotas - php artisan route:cache';

                        $result = Artisan::call('route:cache', []);
                        break;
                    case 'route_clear':
                        $command = 'Limpar Cache de Rotas - php artisan route:clear';

                        $result = Artisan::call('route:clear', []);
                        break;

                    //Queries
                    case 'cache_clear':
                        $command = 'Limpar Cache de Queries - php artisan cache:clear';

                        $result = Artisan::call('cache:clear', []);
                        break;

                    //View
                    case 'view_clear':
                        $command = 'Limpar Cache de Views - php artisan view:clear';

                        $result = Artisan::call('view:clear', []);
                        break;
                }
            } catch (\Exception $e) {
                $result = $e->getMessage();
            }

            $this->request->session()->flash('command', $command);
            $this->request->session()->flash('result', $result);

            return redirect()->route('admin.utils.cacheResult');
        } else {
            return $this->view('panel::general.utils.cacheControl');
        }
    }

    public function cacheResult()
    {
        return $this->view('panel::general.utils.commandResult')->with([
            'command' => $this->request->session()->get('command'),
            'result' => $this->request->session()->get('result')
        ]);
    }
}