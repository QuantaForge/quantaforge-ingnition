<?php

use QuantaQuirk\Ignition\Solutions\SolutionProviders\BadMethodCallSolutionProvider;
use QuantaQuirk\Ignition\Solutions\SolutionProviders\MergeConflictSolutionProvider;
use QuantaQuirk\Ignition\Solutions\SolutionProviders\UndefinedPropertySolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Recorders\DumpRecorder\DumpRecorder;
use QuantaQuirk\QuantaQuirkIgnition\Recorders\JobRecorder\JobRecorder;
use QuantaQuirk\QuantaQuirkIgnition\Recorders\LogRecorder\LogRecorder;
use QuantaQuirk\QuantaQuirkIgnition\Recorders\QueryRecorder\QueryRecorder;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\DefaultDbNameSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\GenericQuantaQuirkExceptionSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\IncorrectValetDbCredentialsSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\InvalidRouteActionSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\MissingAppKeySolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\MissingColumnSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\MissingImportSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\MissingLivewireComponentSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\MissingMixManifestSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\MissingViteManifestSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\RunningQuantaQuirkDuskInProductionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\TableNotFoundSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\UndefinedViewVariableSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\UnknownValidationSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\ViewNotFoundSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\OpenAiSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\SailNetworkSolutionProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Editor
    |--------------------------------------------------------------------------
    |
    | Choose your preferred editor to use when clicking any edit button.
    |
    | Supported: "phpstorm", "vscode", "vscode-insiders", "textmate", "emacs",
    |            "sublime", "atom", "nova", "macvim", "idea", "netbeans",
    |            "xdebug", "phpstorm-remote"
    |
    */

    'editor' => env('IGNITION_EDITOR', 'phpstorm'),

    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    |
    | Here you may specify which theme Ignition should use.
    |
    | Supported: "light", "dark", "auto"
    |
    */

    'theme' => env('IGNITION_THEME', 'auto'),

    /*
    |--------------------------------------------------------------------------
    | Sharing
    |--------------------------------------------------------------------------
    |
    | You can share local errors with colleagues or others around the world.
    | Sharing is completely free and doesn't require an account on Flare.
    |
    | If necessary, you can completely disable sharing below.
    |
    */

    'enable_share_button' => env('IGNITION_SHARING_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Register Ignition commands
    |--------------------------------------------------------------------------
    |
    | Ignition comes with an additional make command that lets you create
    | new solution classes more easily. To keep your default QuantaQuirk
    | installation clean, this command is not registered by default.
    |
    | You can enable the command registration below.
    |
    */

    'register_commands' => env('REGISTER_IGNITION_COMMANDS', false),

    /*
    |--------------------------------------------------------------------------
    | Solution Providers
    |--------------------------------------------------------------------------
    |
    | You may specify a list of solution providers (as fully qualified class
    | names) that should be loaded. Ignition will ignore these classes
    | and possible solutions provided by them will never be displayed.
    |
    */

    'solution_providers' => [
        // from quantaquirk/ignition
        BadMethodCallSolutionProvider::class,
        MergeConflictSolutionProvider::class,
        UndefinedPropertySolutionProvider::class,

        // from quantaquirk/quantaquirk-ignition
        IncorrectValetDbCredentialsSolutionProvider::class,
        MissingAppKeySolutionProvider::class,
        DefaultDbNameSolutionProvider::class,
        TableNotFoundSolutionProvider::class,
        MissingImportSolutionProvider::class,
        InvalidRouteActionSolutionProvider::class,
        ViewNotFoundSolutionProvider::class,
        RunningQuantaQuirkDuskInProductionProvider::class,
        MissingColumnSolutionProvider::class,
        UnknownValidationSolutionProvider::class,
        MissingMixManifestSolutionProvider::class,
        MissingViteManifestSolutionProvider::class,
        MissingLivewireComponentSolutionProvider::class,
        UndefinedViewVariableSolutionProvider::class,
        GenericQuantaQuirkExceptionSolutionProvider::class,
        OpenAiSolutionProvider::class,
        SailNetworkSolutionProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignored Solution Providers
    |--------------------------------------------------------------------------
    |
    | You may specify a list of solution providers (as fully qualified class
    | names) that shouldn't be loaded. Ignition will ignore these classes
    | and possible solutions provided by them will never be displayed.
    |
    */

    'ignored_solution_providers' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Runnable Solutions
    |--------------------------------------------------------------------------
    |
    | Some solutions that Ignition displays are runnable and can perform
    | various tasks. By default, runnable solutions are only enabled when your
    | app has debug mode enabled and the environment is `local` or
    | `development`.
    |
    | Using the `IGNITION_ENABLE_RUNNABLE_SOLUTIONS` environment variable, you
    | can override this behaviour and enable or disable runnable solutions
    | regardless of the application's environment.
    |
    | Default: env('IGNITION_ENABLE_RUNNABLE_SOLUTIONS')
    |
    */

    'enable_runnable_solutions' => env('IGNITION_ENABLE_RUNNABLE_SOLUTIONS'),

    /*
    |--------------------------------------------------------------------------
    | Remote Path Mapping
    |--------------------------------------------------------------------------
    |
    | If you are using a remote dev server, like QuantaQuirk Homestead, Docker, or
    | even a remote VPS, it will be necessary to specify your path mapping.
    |
    | Leaving one, or both of these, empty or null will not trigger the remote
    | URL changes and Ignition will treat your editor links as local files.
    |
    | "remote_sites_path" is an absolute base path for your sites or projects
    | in Homestead, Vagrant, Docker, or another remote development server.
    |
    | Example value: "/home/vagrant/Code"
    |
    | "local_sites_path" is an absolute base path for your sites or projects
    | on your local computer where your IDE or code editor is running on.
    |
    | Example values: "/Users/<name>/Code", "C:\Users\<name>\Documents\Code"
    |
    */

    'remote_sites_path' => env('IGNITION_REMOTE_SITES_PATH', base_path()),
    'local_sites_path' => env('IGNITION_LOCAL_SITES_PATH', ''),

    /*
    |--------------------------------------------------------------------------
    | Housekeeping Endpoint Prefix
    |--------------------------------------------------------------------------
    |
    | Ignition registers a couple of routes when it is enabled. Below you may
    | specify a route prefix that will be used to host all internal links.
    |
    */

    'housekeeping_endpoint_prefix' => '_ignition',

    /*
    |--------------------------------------------------------------------------
    | Settings File
    |--------------------------------------------------------------------------
    |
    | Ignition allows you to save your settings to a specific global file.
    |
    | If no path is specified, a file with settings will be saved to the user's
    | home directory. The directory depends on the OS and its settings but it's
    | typically `~/.ignition.json`. In this case, the settings will be applied
    | to all of your projects where Ignition is used and the path is not
    | specified.
    |
    | However, if you want to store your settings on a project basis, or you
    | want to keep them in another directory, you can specify a path where
    | the settings file will be saved. The path should be an existing directory
    | with correct write access.
    | For example, create a new `ignition` folder in the storage directory and
    | use `storage_path('ignition')` as the `settings_file_path`.
    |
    | Default value: '' (empty string)
    */

    'settings_file_path' => '',

    /*
    |--------------------------------------------------------------------------
    | Recorders
    |--------------------------------------------------------------------------
    |
    | Ignition registers a couple of recorders when it is enabled. Below you may
    | specify a recorders will be used to record specific events.
    |
    */

    'recorders' => [
        DumpRecorder::class,
        JobRecorder::class,
        LogRecorder::class,
        QueryRecorder::class,
    ],

    /*
     * When a key is set, we'll send your exceptions to Open AI to generate a solution
     */

    'open_ai_key' => env('IGNITION_OPEN_AI_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Include arguments
    |--------------------------------------------------------------------------
    |
    | Ignition show you stack traces of exceptions with the arguments that were
    | passed to each method. This feature can be disabled here.
    |
    */

    'with_stack_frame_arguments' => true,

    /*
    |--------------------------------------------------------------------------
    | Argument reducers
    |--------------------------------------------------------------------------
    |
    | Ignition show you stack traces of exceptions with the arguments that were
    | passed to each method. To make these variables more readable, you can
    | specify a list of classes here which summarize the variables.
    |
    */

    'argument_reducers' => [
        \QuantaQuirk\Backtrace\Arguments\Reducers\BaseTypeArgumentReducer::class,
        \QuantaQuirk\Backtrace\Arguments\Reducers\ArrayArgumentReducer::class,
        \QuantaQuirk\Backtrace\Arguments\Reducers\StdClassArgumentReducer::class,
        \QuantaQuirk\Backtrace\Arguments\Reducers\EnumArgumentReducer::class,
        \QuantaQuirk\Backtrace\Arguments\Reducers\ClosureArgumentReducer::class,
        \QuantaQuirk\Backtrace\Arguments\Reducers\DateTimeArgumentReducer::class,
        \QuantaQuirk\Backtrace\Arguments\Reducers\DateTimeZoneArgumentReducer::class,
        \QuantaQuirk\Backtrace\Arguments\Reducers\SymphonyRequestArgumentReducer::class,
        \QuantaQuirk\QuantaQuirkIgnition\ArgumentReducers\ModelArgumentReducer::class,
        \QuantaQuirk\QuantaQuirkIgnition\ArgumentReducers\CollectionArgumentReducer::class,
        \QuantaQuirk\Backtrace\Arguments\Reducers\StringableArgumentReducer::class,
    ],

];
