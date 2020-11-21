<?php


namespace LoaiDev\Form\Tests;

use LoaiDev\Form\Form;
use LoaiDev\Form\FormServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

/**
 * Class TestCase
 * @package LoaiDev\Form\Tests
 */
class TestCase extends Orchestra
{

    public function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations();

        $this->setUpDatabase();

//        $this->setUpFactories();
    }

    protected function getPackageProviders($app)
    {
        return [FormServiceProvider::class];
    }

    protected function setUpDatabase()
    {
        //Package migrations
        include_once __DIR__.'/../database/migrations/create_answers_table.php';
        include_once __DIR__.'/../database/migrations/create_entries_table.php';
        include_once __DIR__ . '/../database/migrations/create_sections_table.php';
        include_once __DIR__.'/../database/migrations/create_forms_table.php';
        include_once __DIR__.'/../database/migrations/create_question_options_table.php';
        include_once __DIR__.'/../database/migrations/create_questions_table.php';


        (new \CreateAnswersTable())->up();
        (new \CreateEntriesTable())->up();
        (new \CreateSectionsTable())->up();
        (new \CreateFormsTable())->up();
        (new \CreateQuestionOptionsTable())->up();
        (new \CreateQuestionsTable())->up();
    }

    protected function setUpFactories()
    {
        $this->withFactories(__DIR__.'/../database/factories');
    }
}
