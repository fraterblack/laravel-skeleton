<?php

namespace Lpf\Support\Generators\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Lpf\Support\Generators\Exceptions\InvalidOptionException;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->validatesOptions();

        if (parent::fire() === false) {
            return;
        }

        $this->createContract();
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createContract()
    {
        $this->call('generate:repository-contract', [
            'name' => $this->argument('name'),
            '--namespace' => $this->option('namespace')
        ]);
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        return $this->replaceModel($stub);
    }

    /**
     * Replace the model for the given stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function replaceModel($stub)
    {
        $stub = str_replace('NamespacedDummyModule', Str::studly($this->option('namespace')), $stub);

        $stub = str_replace('DummyModel', Str::studly($this->option('model')), $stub);

        return $stub;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/repository.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domains\\' . Str::studly($this->option('namespace')) . '\Repositories';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_REQUIRED, 'The model that the repository applies to.'],
            ['namespace', 'ns', InputOption::VALUE_REQUIRED, 'The namespace of module that the repository applies to.'],
        ];
    }

    /**
     * Validate obligatory options
     *
     * @throws InvalidOptionException
     *
     * @return bool
     */
    protected function validatesOptions()
    {
        if (empty($this->option('namespace'))) {
            throw new InvalidOptionException('The namespace module option is obligatory.');
        }

        if (empty($this->option('model'))) {
            throw new InvalidOptionException('The model option is obligatory');
        }

        return true;
    }
}
