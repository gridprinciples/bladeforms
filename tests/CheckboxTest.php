<?php

namespace GridPrinciples\BladeForms\Tests;

class CheckboxTest extends TestCase
{
    public function test_it_can_render_as_a_lone_checkbox()
    {
        $output = $this->withViewErrors([])
            ->blade('<x-form::checkbox name="remember" label="Remember me" />');

        $this->assertHtmlContainsNode($output, '//input[@type="checkbox"][@name="remember"]');
        $this->assertHtmlContainsNode($output, '//label/span[contains(text(),"Remember me")]');
    }

    public function test_it_can_render_as_checkbox_list()
    {
        $output = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list name="favorite" label="Who could defeat Voldemort?" :options="[
                \'picard\' => \'Picard\',
                \'kirk\' => \'Kirk\',
            ]" />');

        $this->assertHtmlContainsNode($output, '//input[@type="checkbox"][@name="favorite[]"][@value="picard"]/following-sibling::*[1][contains(text(),"Picard")]');
        $this->assertHtmlContainsNode($output, '//input[@type="checkbox"][@name="favorite[]"][@value="kirk"]/following-sibling::*[1][contains(text(),"Kirk")]');
    }

    public function test_it_can_have_attribute_array_options()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list :options="[
                \'yes\' => [
                    \'label\' => \'Yes\', 
                    \'disabled\' => true,
            ],
                \'no\' => \'No\',
            ]" />');

        $this->assertHtmlContainsNode($view, '//input[@type="checkbox"][@value="yes"][@disabled]');
        $this->assertHtmlDoesntContainNode($view, '//input[@type="checkbox"][@value="no"][@disabled]');
    }

    public function test_it_can_optionally_set_a_label()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
            ]" />');

        $this->assertHtmlDoesntContainNode($view, '//labelegend');

        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list label="Select a team" :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
            ]" />');

        $this->assertHtmlContainsNode($view, '//legend[contains(text(),"Select a team")]');

        $this->assertHtmlDoesntContainNode($view, '//input[@label]');
    }

    public function test_it_can_set_accessible_help_text()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list help="Gondor needs no king." id="king" :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
            ]" />');

        $this->assertHtmlContainsNode($view, '//*[@aria-describedby="king_feedback"]');

        $this->assertHtmlContainsNode($view, '//*[@id="king_feedback"]//*[contains(text(),"Gondor needs no king.")]');

        $this->assertHtmlDoesntContainNode($view, '//input[@help]');
        $this->assertHtmlDoesntContainNode($view, '//*[@help]');
    }

    public function test_it_can_customize_the_value()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox value="bob_buttons" />');

        $this->assertHtmlContainsNode($view, '//input[@value="bob_buttons"]');
    }

    public function test_it_can_set_a_prefilled_value()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list :value="[\'no\']" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        $this->assertHtmlContainsNode($view, '//input[@value="no"][@checked]');
        $this->assertHtmlDoesntContainNode($view, '//input[@value="yes"][@checked]');
    }

    public function test_it_presents_as_required_when_necessary()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list label="Family Name" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" required />');

        $this->assertHtmlContainsNode($view, '//legend[contains(text(),"*")]');
        $this->assertHtmlContainsNode($view, '//legend//*[contains(text(),"(required)")]');
        $this->assertHtmlContainsNode($view, '//input[@type="checkbox"][@required]');

        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list label="Given Name" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        $this->assertHtmlDoesntContainNode($view, '//legend[contains(text(),"*")]');
        $this->assertHtmlDoesntContainNode($view, '//legend//*[contains(text(),"(required)")]');
        $this->assertHtmlDoesntContainNode($view, '//input[@type="checkbox"][@required]');
    }

    public function test_it_displays_submitted_input_data()
    {
        $this->markTestSkipped('Sessions might not be in scope to test here.');

        // Session::put('_old_input', ['king' => ['aragorn']]);

        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list name="king" :checked="[\'boromir\']" :options="[\'boromir\' => \'Boromir\', \'aragorn\' => \'Aragorn\']" />');

        $this->assertHtmlContainsNode($view, '//input[@type="checkbox"][@value="aragorn"][@checked]');
    }

    public function test_it_displays_a_validation_error_from_request()
    {
        $view = $this->withViewErrors([
            'your_email' => [
                'This field is required.',
            ],
        ])->blade('<x-form::checkbox-list :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
            ]" name="your_email" id="email_checkboxes" />');

        $this->assertHtmlContainsNode($view, '//*[@aria-describedby="email_checkboxes_feedback"]');
        $this->assertHtmlContainsNode($view, '//*[@id="email_checkboxes_feedback"]//*[contains(text(),"This field is required.")]');
    }

    public function test_it_displays_an_arbitrary_error_message()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
            ]" name="oops" id="input_oops" error="You really done it now" />');

        $this->assertHtmlContainsNode($view, '//*[@aria-describedby="input_oops_feedback"]');
        $this->assertHtmlContainsNode($view, '//*[@id="input_oops_feedback"]//*[contains(text(),"You really done it now")]');

        $this->assertHtmlDoesntContainNode($view, '//*[@error]');
    }

    public function test_it_can_add_attributes_to_the_group()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list name="bloober" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" :wrapperAttributes="[\'id\' => \'bloober_group\', \'class\' => \'mb-7\']" />');

        $this->assertHtmlContainsNode($view, '//*[@id="bloober_group"]//input[@type="checkbox"][@name="bloober[]"]');

        $this->assertHtmlContainsNode($view, '//*['.$this->xpathCheckClass('mb-7').']//input[@type="checkbox"][@name="bloober[]"]');
    }

    public function test_it_can_add_attributes_to_the_label()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
            ]" name="bloober" label="Bloober Team" :labelAttributes="[\'id\' => \'bloober_label\']" />');

        $this->assertHtmlContainsNode($view, '//legend[@id="bloober_label"]');
    }

    public function test_it_can_add_attributes_to_the_input_group()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list name="bloober" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" :inputGroupAttributes="[\'id\' => \'bloober_special\', \'class\' => \'mb-11\']" />');

        $this->assertHtmlContainsNode($view, '//*[@id="bloober_special"]//input[@type="checkbox"][@name="bloober[]"]');

        $this->assertHtmlContainsNode($view, '//*['.$this->xpathCheckClass('mb-11').']//input[@type="checkbox"][@name="bloober[]"]');
    }

    public function test_it_can_set_arbitrary_attributes_on_the_input()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::checkbox-list :options="[
                \'yes\' => [\'label\' => \'Yes\', \':something\' => \'{\\\'success\\\':true}\'], 
                \'no\' => [\'label\' => \'No\', \'data-key\' => 42],
            ]" />');

        $this->assertHtmlContainsNodeCount($view, '//input[@type="checkbox"][@data-key="42"]', 1);

        $view->assertSeeInOrder([
            '<input',
            ':something="{\'success\':true}"',
            '/>',
            '<input',
            'data-key="42"',
            '/>',
        ], false);
    }
}
