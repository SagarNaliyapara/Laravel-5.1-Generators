<?php namespace SKagarwal\Generators\Commands;

use Illuminate\Console\Command;
use SKAgarwal\Generators\EventGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class EventGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'create:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Model Specific Event Class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(EventGenerator $eventGen)
    {
        $event = $this->argument('name');
        $model = $this->option('model');
        $eventGen->generate($event, $model);

        $event = ucfirst($event);
        if ($model) {
            $model = ucfirst($model);
            $this->info("Created: app\\$model\\Events\\$event.php");
        }
        else {
            $this->info("Created: app\\Events\\$event.php");
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'Name of the event class to be created.'
            ],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                '--model',
                '-m',
                InputOption::VALUE_REQUIRED,
                'Name of the model under which event will be created.',
                null
            ],
        ];
    }
}
