<?php

namespace AwStudio\Prepper\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LocalizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prepper:localize';

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
        $makeMultilingual = $this->confirm('Is it a mulitlanguage project?', false);
        $locale = $this->choice('What is the default locale?', ['de', 'en'], 'de');

        if ($makeMultilingual) {
            $this->makeMultilingual($locale);
        } else {
            $this->makeMonolingual($locale);
        }
    }

    /**
     * Make changes to files in order to make app multilingual.
     *
     * @return void
     */
    public function makeMultilingual($locale): void
    {
        // trans routes
        $webRoutes = base_path('routes/web.php');
        if (file_exists($webRoutes)) {
            $file_contents = file_get_contents($webRoutes);
            $file_contents = str_replace('Route::get', 'Route::trans', $file_contents);
            file_put_contents($webRoutes, $file_contents);

            File::append($webRoutes, "\nRoute::redirect('/', '/".$locale."');");
        }

        $litstackServiceProvider = base_path('lit/app/Providers/LitstackServiceProvider.php');
        if (file_exists($litstackServiceProvider)) {
            $file_contents = file_get_contents($litstackServiceProvider);
            $file_contents = str_replace('=> route', '=> __route', $file_contents);
            file_put_contents($litstackServiceProvider, $file_contents);
        }

        // set default locale in translatable config
        $translatable = config_path('translatable.php');
        if (file_exists($translatable)) {
            $file_contents = file_get_contents($translatable);
            $file_contents = str_replace("'fallback_locale' => 'en',", "'fallback_locale' => '".$locale."',", $file_contents);

            // put locales in the right order
            $find = "'locales' => [
        'en',
        'de',
    ],";

            $locales = [$locale];
            foreach (['en', 'de'] as $item) {
                if ($item != $locale) {
                    $locales[] = $item;
                }
            }
            $replace = "'locales' => ['".implode("','", $locales)."'],";

            $file_contents = file_get_contents($translatable);
            $file_contents = str_replace(
                $find,
                $replace,
                $file_contents
            );

            // defult locale
            $file_contents = str_replace(
                "'fallback_locale' => 'en'",
                "'fallback_locale' => '".$locale."'",
                $file_contents
            );

            file_put_contents($translatable, $file_contents);
        }
    }

    /**
     * Make changes to files in order to make app monolingual.
     *
     * @return void
     */
    public function makeMonolingual($locale): void
    {
        // trans routes
        $app = config_path('app.php');
        if (file_exists($app)) {
            $file_contents = file_get_contents($app);
            $file_contents = str_replace("'en'", "'".$locale."'", $file_contents);
            file_put_contents($app, $file_contents);
        }

        $translatable = config_path('translatable.php');
        if (file_exists($translatable)) {
            $find = "'locales' => [
        'en',
        'de',
    ],";
            $replace = "'locales' => ['".$locale."'],";

            $file_contents = file_get_contents($translatable);
            $file_contents = str_replace(
                $find,
                $replace,
                $file_contents
            );
            $file_contents = str_replace("'fallback_locale' => 'en',", "'fallback_locale' => '".$locale."',", $file_contents);
            file_put_contents($translatable, $file_contents);
        }
    }
}
