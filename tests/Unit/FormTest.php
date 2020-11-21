<?php

namespace LoaiDev\Form\Tests\Unit;

use LoaiDev\Form\Form;
use LoaiDev\Form\Tests\TestCase;


class FormTest extends TestCase
{
    /**
     * @var Form
     */
    protected $form;

    public function setUp(): void
    {
        parent::setUp();
        $form = Form::create(['name' => 'this is a test form']);
        $section = $form->sections()->create(['title' => 'first section', 'order' => 1]);
        $section->questions()->create(['title' => 'test 1 question', 'type' => 'text', 'rules' => ['string', 'required']]);
        $section->questions()->create(['title' => 'test 2 question', 'type' => 'text', 'rules' => ['array', 'unique']]);
        $section = $form->sections()->create(['title' => 'second section', 'order' => 2]);
        $section->questions()->create(['title' => 'test 3 question', 'type' => 'text', 'rules' => ['unique']]);
        $this->form = $form;
    }

    /** @test */
    public function can_create_form()
    {
        Form::create(['name' => 'testForm']);
        $this->assertTrue(Form::query()->exists());
    }

    /** @test */
    public function can_set_and_get_form_name()
    {
        $form = new Form;
        $form->name = 'test';
        $form->save();
        $form->refresh();
        $this->assertEquals('test', $form->name);
    }


    /** @test */
    public function can_set_and_get_form_settings()
    {

        $form = Form::create(['name' => 'testForm']);
        $form->{'settings->pages'} = 10;
        $form->setAttribute('settings->number', 5);
        $form->fill(['settings->nested->property' => 'string']);
        $form->save();
        $newForm = Form::where('settings->pages', 10)->get()->first();
        $this->assertEquals(5, $newForm->settings['number']);
        $this->assertEquals(10, $newForm->settings['pages']);
        $this->assertEquals('string', $newForm->settings['nested']['property']);
    }

    /** @test */
    public function form_has_public_id()
    {
        Form::create(['name' => 'this is a test form']);
        $form = Form::create(['name' => 'this is a test form']);
        $this->assertNotNull($form->public_id);

    }

    /** @test */
    public function form_has_questions()
    {
        $this->assertIsArray($this->form->questions->all());
    }

    /** @test */
    public function form_has_rules()
    {
        $this->assertNotNull($this->form->rules);
    }
}
