<?php

namespace LoaiDev\Form;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/form.php' => config_path('form.php'),
            ], 'config');

            $this->publishMigrations();
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/form.php', 'form');
    }

    public function publishMigrations()
    {
        $migrationNames = [
            'create_answers_table',
            'create_entries_table',
            'create_forms_table',
            'create_question_options_table',
            'create_questions_table',
            'create_sections_table',
        ];

        $migrations = [];
        foreach ($migrationNames as $migrationName) {
            $migrations[__DIR__ . "/../database/migrations/$migrationName.php.stub"] =
                database_path('migrations/' . date('Y_m_d_His', time()) . "_$migrationName.php");
        }
        $this->publishes($migrations, 'migrations');

    }
}
