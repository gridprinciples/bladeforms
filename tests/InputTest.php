<?php

namespace GridPrinciples\BladeForms\Tests;

class InputTest extends TestCase
{    
    public function test_it_sets_a_default_type()
    {
        $this->withViewErrors([]);

        $output = $this->blade('<x-form::input />');
        
        $this->assertHtmlContainsNode($output, '//input[@type="text"]');
    }

    public function test_it_can_override_default_type()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input type="password" />');

        $this->assertHtmlContainsNode($view, '//input[@type="password"]');
    }

    public function test_it_sets_a_default_id()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input />');

        $this->assertHtmlContainsNode($view, '//input[@id]');
    }

    public function test_it_can_override_default_id()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input id="grungion" />');

        $this->assertHtmlContainsNode($view, '//input[@id="grungion"]');
    }

    public function test_it_can_optionally_set_a_label()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input />');

        $this->assertHtmlDoesntContainNode($view, '//label');

        $view = $this->withViewErrors([])
            ->blade('<x-form::input label="Oh bother" />');

        $this->assertHtmlContainsNode($view, '//label[@for][contains(text(),"Oh bother")]');

        $this->assertHtmlDoesntContainNode($view, '//input[@label]');
    }

    public function test_it_can_set_accessible_help_text()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input help="Gondor needs no king." id="king" />');

        $this->assertHtmlContainsNode($view, '//input[@aria-describedby="king_feedback"]');

        $this->assertHtmlContainsNode($view, '//*[@id="king_feedback"]//*[contains(text(),"Gondor needs no king.")]');

        $this->assertHtmlDoesntContainNode($view, '//input[@help]');
    }

    public function test_it_can_set_a_prefilled_value()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input value="Boromir" />');

        $this->assertHtmlContainsNode($view, '//input[@value="Boromir"]');
    }

    public function test_it_presents_as_required_when_necessary()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input label="Family Name" required />');

        $this->assertHtmlContainsNode($view, '//label[contains(text(),"*")]');
        $this->assertHtmlContainsNode($view, '//label//*[contains(text(),"(required)")]');
        $this->assertHtmlContainsNode($view, '//input[@required]');

        $view = $this->withViewErrors([])
            ->blade('<x-form::input label="Given Name" />');

        $this->assertHtmlDoesntContainNode($view, '//label//*[contains(text(),"*")]');
        $this->assertHtmlDoesntContainNode($view, '//label//*[contains(text(),"(required)")]');
        $this->assertHtmlDoesntContainNode($view, '//input[@required]');
    }

    public function test_it_displays_submitted_input_data()
    {
        $this->markTestSkipped('Sessions might not be in scope to test here.');
        // $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');

        // request()->flash(['_old_input.king' => 'Aragorn']);

        $this->withSession(['_old_input.king' => 'Aragorn']);
        // Session::flash('_old_input', ['king' => 'Aragorn']);
        // session()->put('_old_input', ['king' => 'Aragorn']);

        $view = $this->withViewErrors([])
            ->blade('<x-form::input name="king" value="Boromir" />');

        $this->assertHtmlContainsNode($view, '//input[@value="Aragorn"]');
    }

    public function test_it_displays_a_validation_error_from_request()
    {
        $view = $this->withViewErrors([
            'your_email' => [
                'This field is required.',
            ]
        ])->blade('<x-form::input name="your_email" id="email_input" />');

        $this->assertHtmlContainsNode($view, '//input[@aria-describedby="email_input_feedback"]');
        $this->assertHtmlContainsNode($view, '//*[@id="email_input_feedback"]//*[contains(text(),"This field is required.")]');
    }

    public function test_it_displays_an_arbitrary_error_message()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input name="oops" id="input_oops" error="You really done it now" />');

        $this->assertHtmlContainsNode($view, '//input[@aria-describedby="input_oops_feedback"]');
        $this->assertHtmlContainsNode($view, '//*[@id="input_oops_feedback"]//*[contains(text(),"You really done it now")]');

        $this->assertHtmlDoesntContainNode($view, '//input[@error]');
    }

    public function test_it_can_add_attributes_to_the_group()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input name="bloober" :wrapperAttributes="[\'id\' => \'bloober_group\', \'class\' => \'mb-7\']" />');

        $this->assertHtmlContainsNode($view, '//*[@id="bloober_group"]//input[@name="bloober"]');

        $this->assertHtmlContainsNode($view, '//*[' . $this->xpathCheckClass('mb-7') . ']//input[@name="bloober"]');
    }

    public function test_it_can_add_attributes_to_the_label()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input name="bloober" label="Bloober Team" :labelAttributes="[\'id\' => \'bloober_label\']" />');

        $this->assertHtmlContainsNode($view, '//label[@id="bloober_label"]');
    }

    public function test_it_can_add_attributes_to_the_input_group()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input name="bloober" :inputGroupAttributes="[\'id\' => \'bloober_special\', \'class\' => \'mb-11\']" />');

        $this->assertHtmlContainsNode($view, '//*[@id="bloober_special"]//input[@name="bloober"]');

        $this->assertHtmlContainsNode($view, '//*[' . $this->xpathCheckClass('mb-11') . ']//input[@name="bloober"]');
    }

    public function test_it_can_set_arbitrary_attributes_on_the_input()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::input data-key="42" ::something-else="{\'success\':true}" />');

        $this->assertHtmlContainsNode($view, '//input[@data-key="42"]');

        // Can't figure out how to make XPath behave with the :attribute.
        $view->assertSeeInOrder([
            '<input',
            ':something-else="{\'success\':true}"',
            '/>'
        ], false);
    }
}