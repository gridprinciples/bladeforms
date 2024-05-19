<?php

namespace GridPrinciples\BladeForms\Tests;

class FormTextareaTest extends TestCase
{
    public function test_it_sets_a_default_id()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea />');

        $this->assertHtmlContainsNode($view, '//textarea[@id]');
    }

    public function test_it_can_override_default_id()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea id="grungion" />');

        $this->assertHtmlContainsNode($view, '//textarea[@id="grungion"]');
    }

    public function test_it_can_optionally_set_a_label()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea />');

        $this->assertHtmlDoesntContainNode($view, '//label');

        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea label="Oh bother" />');

        $this->assertHtmlContainsNode($view, '//label[@for][contains(text(),"Oh bother")]');

        $this->assertHtmlDoesntContainNode($view, '//textarea[@label]');
    }

    public function test_it_can_set_accessible_help_text()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea help="Gondor needs no king." id="king" />');

        $this->assertHtmlContainsNode($view, '//textarea[@aria-describedby="king_feedback"]');

        $this->assertHtmlContainsNode($view, '//*[@id="king_feedback"]//*[contains(text(),"Gondor needs no king.")]');

        $this->assertHtmlDoesntContainNode($view, '//textarea[@help]');
    }

    public function test_it_can_set_a_prefilled_value()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea value="Boromir" />');

        $this->assertHtmlContainsNode($view, '//textarea[contains(text(),"Boromir")]');
    }

    public function test_it_presents_as_required_when_necessary()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea label="Family Name" required />');

        $this->assertHtmlContainsNode($view, '//label[contains(text(),"*")]');
        $this->assertHtmlContainsNode($view, '//label//*[contains(text(),"(required)")]');
        $this->assertHtmlContainsNode($view, '//textarea[@required]');

        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea label="Given Name" />');

        $this->assertHtmlDoesntContainNode($view, '//label//*[contains(text(),"*")]');
        $this->assertHtmlDoesntContainNode($view, '//label//*[contains(text(),"(required)")]');
        $this->assertHtmlDoesntContainNode($view, '//textarea[@required]');
    }

    public function test_it_displays_submitted_input_data()
    {
        $this->markTestSkipped('Sessions might not be in scope to test here.');

        // Session::put('_old_input', ['king' => 'Aragorn']);

        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea name="king" value="Boromir" />');

        $this->assertHtmlContainsNode($view, '//textarea[contains(text(),"Aragorn")]');
    }

    public function test_it_displays_a_validation_error_from_request()
    {
        $view = $this->withViewErrors([
            'your_email' => [
                'This field is required.',
            ],
        ])->blade('<x-form::textarea name="your_email" id="email_input" />');

        $this->assertHtmlContainsNode($view, '//textarea[@aria-describedby="email_input_feedback"]');
        $this->assertHtmlContainsNode($view, '//*[@id="email_input_feedback"]//*[contains(text(),"This field is required.")]');
    }

    public function test_it_displays_an_arbitrary_error_message()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea name="oops" id="input_oops" error="You really done it now" />');

        $this->assertHtmlContainsNode($view, '//textarea[@aria-describedby="input_oops_feedback"]');
        $this->assertHtmlContainsNode($view, '//*[@id="input_oops_feedback"]//*[contains(text(),"You really done it now")]');

        $this->assertHtmlDoesntContainNode($view, '//textarea[@error]');
    }

    public function test_it_can_add_attributes_to_the_group()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea name="bloober" :wrapperAttributes="[\'id\' => \'bloober_group\', \'class\' => \'mb-7\']" />');

        $this->assertHtmlContainsNode($view, '//*[@id="bloober_group"]//textarea[@name="bloober"]');

        $this->assertHtmlContainsNode($view, '//*['.$this->xpathCheckClass('mb-7').']//textarea[@name="bloober"]');
    }

    public function test_it_can_add_attributes_to_the_label()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea name="bloober" label="Bloober Team" :labelAttributes="[\'id\' => \'bloober_label\']" />');

        $this->assertHtmlContainsNode($view, '//label[@id="bloober_label"]');
    }

    public function test_it_can_add_attributes_to_the_input_group()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea name="bloober" :inputGroupAttributes="[\'id\' => \'bloober_special\', \'class\' => \'mb-11\']" />');

        $this->assertHtmlContainsNode($view, '//*[@id="bloober_special"]//textarea[@name="bloober"]');

        $this->assertHtmlContainsNode($view, '//*['.$this->xpathCheckClass('mb-11').']//textarea[@name="bloober"]');
    }

    public function test_it_can_set_arbitrary_attributes_on_the_textarea()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::textarea data-key="42" ::something-else="{\'success\':true}" />');

        $this->assertHtmlContainsNode($view, '//textarea[@data-key="42"]');

        // Can't figure out how to make XPath behave with the :attribute.
        $view->assertSeeInOrder([
            '<textarea',
            ':something-else="{\'success\':true}"',
            '>',
            '</textarea>',
        ], false);
    }
}
