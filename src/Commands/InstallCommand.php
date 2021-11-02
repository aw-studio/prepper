<?php

namespace AwStudio\Prepper\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prepper:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $withLitstack = $this->confirm('Install litstack?', true);
        $withCms = $this->confirm('Install CMS (pages, bladesmith, meta)?', true);

        // $makeMultilingual = $this->confirm('Is it a mulitlanguage project?', false);
        // $locale = $this->choice('What is the default locale?', ['de', 'en'], 'de');

        $this->installVittStack();

        if ($withLitstack) {
            $this->installLitstack();
        }
        if ($withCms) {
            $this->installCms();
            $this->comment("\nPlease execute 'php artisan prepper:publish'.\n");
            $this->comment("\nPlease execute 'php artisan prepper:seed'.\n");
            $this->comment("\nPlease execute 'php artisan prepper:localize'.\n");
        }

        $this->callSilent('migrate');

        $this->comment("\nPlease execute 'npm install && npm run dev'.\n");
    }

    public function installVittStack()
    {
        // cleanup
        if (File::exists(resource_path('views/welcome.blade.php'))) {
            File::delete(resource_path('views/welcome.blade.php'));
        }
        if (File::exists(resource_path('js'))) {
            File::deleteDirectory(resource_path('js'));
        }
        if (File::exists(resource_path('css'))) {
            File::deleteDirectory(resource_path('css'));
        }

        // copy assets
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/vitt/resources/js', resource_path('js'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/vitt/resources/css', resource_path('css'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/vitt/Controllers/Pages', app_path('Http/Controllers/Pages'));

        // copy views
        copy(__DIR__.'/../../stubs/vitt/resources/views/app.blade.php', resource_path('views/app.blade.php'));

        // copy confg files
        copy(__DIR__.'/../../stubs/config/shims-vue.d.ts', base_path('shims-vue.d.ts'));
        copy(__DIR__.'/../../stubs/config/tsconfig.json', base_path('tsconfig.json'));
        copy(__DIR__.'/../../stubs/config/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/../../stubs/config/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/../../stubs/config/.php-cs-fixer.dist.php', base_path('.php-cs-fixer.dist.php'));
        copy(__DIR__.'/../../stubs/config/.prettierignore', base_path('.prettierignore'));
        copy(__DIR__.'/../../stubs/config/.prettierrc', base_path('.prettierrc'));

        copy(__DIR__.'/../../stubs/vitt/routes/web.php', base_path('routes/web.php'));

        // add app url to mix
        if ($url = env('APP_URL')) {
            $data = "
mix.browserSync({
    proxy: '$url',
    notify: false
});";

            File::append(base_path('webpack.mix.js'), $data);
        }

        // add npm packages
        $this->updateNodePackages(function ($packages) {
            return [
                '@inertiajs/inertia'      => '^0.10.0',
                '@inertiajs/inertia-vue3' => '^0.5.1',
                '@tailwindcss/typography' => '^0.4.1',
                '@vue/compiler-sfc'       => '^3.1.5',
                'tailwindcss'             => '^2.2.7',
                'ts-loader'               => '^9.2.4',
                'typescript'              => '^4.3.5',
                'vue'                     => '^3.1.5',
                'vue-loader'              => '^16.4.1',
            ] + $packages;
        });

        // Install Inertia...
        $this->requireComposerPackages('inertiajs/inertia-laravel:^0.4.3', 'tightenco/ziggy:^1.0');

        // Middleware...
        (new Process(['php', 'artisan', 'inertia:middleware', 'HandleInertiaRequests', '--force'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        $this->installMiddlewareAfter('SubstituteBindings::class', '\App\Http\Middleware\HandleInertiaRequests::class');
    }

    public function installLitstack()
    {
        $this->requireComposerPackages(
            'litstack/litstack:^3.7',
        );
        (new Process(['php', 'artisan', 'lit:install'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        $lit = config_path('lit.php');
        if (file_exists($lit)) {
            $find = "'sm' => [300, 300, 8],";
            $replace = "'thumb' => [10, 10, 1],
            'sm' => [300, 300, 8],";

            $file_contents = file_get_contents($lit);
            $file_contents = str_replace(
                $find,
                $replace,
                $file_contents
            );
            file_put_contents($lit, $file_contents);
        }
    }

    public function installCms()
    {
        // add litstack store
        $this->addLitstackStoreToComposerJson();

        // install composer packages
        $this->requireComposerPackages(
            'litstack/bladesmith:^1.0',
            'litstack/pages:^2.1',
            'litstack/meta:^2.0',
        );

        $this->updateNodePackages(function ($packages) {
            return [
                '@aw-studio/vue-lit-block'      => '^1.0',
                '@aw-studio/vue-lit-image-next' => '^1.1.2',
                '@headlessui/vue'               => '^1.4.0',
            ] + $packages;
        });

        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/lit/app/Config/Pages', base_path('lit/app/Config/Pages'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/lit/app/Http/Controllers/Pages', base_path('lit/app/Http/Controllers/Pages'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/lit/app/Repeatables', base_path('lit/app/Repeatables'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/lit/app/Config/Form', base_path('lit/app/Config/Form'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/lit/app/Macros', base_path('lit/app/Macros'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/lit/app/Http/Controllers/Form', base_path('lit/app/Http/Controllers/Form'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/Http/Resources', app_path('Http/Resources'));

        copy(__DIR__.'/../../stubs/cms/Http/Controllers/HomeController.php', app_path('Http/Controllers/Pages/HomeController.php'));
        copy(__DIR__.'/../../stubs/cms/Http/Controllers/RootController.php', app_path('Http/Controllers/Pages/RootController.php'));
        copy(__DIR__.'/../../stubs/cms/Http/Middleware/HandleInertiaRequests.php', app_path('Http/Middleware/HandleInertiaRequests.php'));
        copy(__DIR__.'/../../stubs/cms/lit/app/Config/NavigationConfig.php', base_path('lit/app/Config/NavigationConfig.php'));

        (new Filesystem)->ensureDirectoryExists(base_path('lit/app/Providers'));
        copy(__DIR__.'/../../stubs/cms/lit/app/Providers/LitstackServiceProvider.php', base_path('lit/app/Providers/LitstackServiceProvider.php'));
        copy(__DIR__.'/../../stubs/cms/routes/web.php', base_path('routes/web.php'));

        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/resources/js/Repeatables', resource_path('js/Repeatables'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/cms/resources/js/Pages/Root', resource_path('js/Pages/Root'));

        copy(__DIR__.'/../../stubs/cms/resources/js/app.ts', resource_path('js/app.ts'));
    }

    /**
     * Add the litstack store to the composer json when missing.
     *
     * @return void
     */
    protected function addLitstackStoreToComposerJson()
    {
        $path = base_path('composer.json');
        $store = [
            'type' => 'composer',
            'url'  => 'https://store.litstack.io',
        ];
        $json = json_decode(file_get_contents($path), true);

        if (array_key_exists('repositories', $json) && in_array($store, $json['repositories'])) {
            return;
        }

        $repositories = [];
        if (array_key_exists('repositories', $json)) {
            $repositories = $json['repositories'];
        }

        $json['repositories'] = array_merge($repositories, [$store]);

        file_put_contents($path, json_encode($json, JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES));
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $command = array_merge(
            $command ?? ['composer', 'require', '-W'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable $callback
     * @param  bool     $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Install the middleware to a group in the application Http Kernel.
     *
     * @param  string $after
     * @param  string $name
     * @param  string $group
     * @return void
     */
    protected function installMiddlewareAfter($after, $name, $group = 'web')
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $middlewareGroups = Str::before(Str::after($httpKernel, '$middlewareGroups = ['), '];');
        $middlewareGroup = Str::before(Str::after($middlewareGroups, "'$group' => ["), '],');

        if (! Str::contains($middlewareGroup, $name)) {
            $modifiedMiddlewareGroup = str_replace(
                $after.',',
                $after.','.PHP_EOL.'            '.$name.',',
                $middlewareGroup,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $middlewareGroups,
                str_replace($middlewareGroup, $modifiedMiddlewareGroup, $middlewareGroups),
                $httpKernel
            ));
        }
    }
}
