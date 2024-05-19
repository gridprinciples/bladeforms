<?php

namespace GridPrinciples\BladeForms\Tests;

class SelectTest extends TestCase
{    
    public function test_it_can_render()
    {
        $output = $this->withViewErrors([])
            ->blade('<x-form::select name="show" label="Which show do you like?" :options="[
                \'tng\' => \'The Next Generation\',
                \'ds9\' => \'Deep Space 9\',
                \'voy\' => \'Voyager\',
            ]" />');

        $this->assertHtmlContainsNode($output, '//select[@name="show"]');
        $this->assertHtmlContainsNode($output, '//select/option[@value="tng"][contains(text(),"The Next Generation")]');
        $this->assertHtmlContainsNode($output, '//select/option[@value="ds9"][contains(text(),"Deep Space 9")]');
        $this->assertHtmlContainsNode($output, '//select/option[@value="voy"][contains(text(),"Voyager")]');
        $this->assertHtmlContainsNode($output, '//label[contains(text(),"Which show do you like?")]');
    }



    public function test_it_can_override_default_id()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select id="grungion" />');

        $this->assertHtmlContainsNode($view, '//select[@id="grungion"]');
    }

    public function test_it_can_have_simple_options()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
            ]" />');

        $this->assertHtmlContainsNode($view, '//select/option[@value="yes"][contains(text(),"Yes")]/following-sibling::option[1][@value="no"][contains(text(),"No")]');
    }

    public function test_it_can_have_attribute_array_options()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select :options="[
                \'yes\' => [
                    \'label\' => \'Yes\', 
                    \'disabled\' => true,
            ],
                \'no\' => \'No\',
            ]" />');

        $this->assertHtmlContainsNode($view, '//select/option[@value="yes"][@disabled]');
    }

    public function test_it_can_have_optgroups()
    {
        $this->markTestSkipped('Optgroups are not yet supported.');

        $view = $this->withViewErrors([])
            ->blade('<x-form::select :options="[
                \'Choices\' => [
                    \'yes\' => [
                        \'label\' => \'Yes\', 
                        \'disabled\' => true,
                    ],
                    \'no\' => \'No\',
            ]]" />');

        $this->assertHtmlContainsNode($view, '//select/optgroup[@label="Choices"]/option[@value="yes"][@disabled]/following-sibling::option[@value="no"]');
    }

    public function test_it_can_optionally_set_a_label()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select />');

        $this->assertHtmlDoesntContainNode($view, '//label');

        $view = $this->withViewErrors([])
            ->blade('<x-form::select label="Oh bother" />');


        $this->assertHtmlContainsNode($view, '//label[@for][contains(text(),"Oh bother")]');

        $this->assertHtmlDoesntContainNode($view, '//select[@label]');
    }

    public function test_it_can_set_accessible_help_text()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select help="Gondor needs no king." id="king" />');

        $this->assertHtmlContainsNode($view, '//select[@aria-describedby="king_feedback"]');

        $this->assertHtmlContainsNode($view, '//*[@id="king_feedback"]//*[contains(text(),"Gondor needs no king.")]');

        $this->assertHtmlDoesntContainNode($view, '//select[@help]');
    }

    public function test_it_can_set_a_prefilled_value()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select value="no" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        $this->assertHtmlContainsNode($view, '//option[@value="no"][@selected]');
        $this->assertHtmlDoesntContainNode($view, '//option[@value="yes"][@selected]');
    }

    public function test_it_presents_as_required_when_necessary()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select label="Family Name" required />');

        $this->assertHtmlContainsNode($view, '//label[contains(text(),"*")]');
        $this->assertHtmlContainsNode($view, '//label//*[contains(text(),"(required)")]');
        $this->assertHtmlContainsNode($view, '//select[@required]');

        $view = $this->withViewErrors([])
            ->blade('<x-form::select label="Given Name" />');

        $this->assertHtmlDoesntContainNode($view, '//label[contains(text(),"*")]');
        $this->assertHtmlDoesntContainNode($view, '//label//*[contains(text(),"(required)")]');
        $this->assertHtmlDoesntContainNode($view, '//select[@required]');
    }

    public function test_it_displays_submitted_input_data()
    {
        $this->markTestSkipped('Sessions might not be in scope to test here.');

        // Session::put('_old_input', ['king' => 'aragorn']);

        $view = $this->withViewErrors([])
            ->blade('<x-form::select name="king" value="boromir" :options="[\'boromir\' => \'Boromir\', \'aragorn\' => \'Aragorn\']" />');

        $this->assertHtmlContainsNode($view, '//select//option[@value="aragorn"][@selected]');
    }

    public function test_it_displays_a_validation_error_from_request()
    {
        $view = $this->withViewErrors([
            'your_email' => [
                'This field is required.',
            ]
        ])->blade('<x-form::select name="your_email" id="email_input" />');

        $this->assertHtmlContainsNode($view, '//select[@aria-describedby="email_input_feedback"]');
        $this->assertHtmlContainsNode($view, '//*[@id="email_input_feedback"]//*[contains(text(),"This field is required.")]');
    }

    public function test_it_displays_an_arbitrary_error_message()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select name="oops" id="input_oops" error="You really done it now" />');

        $this->assertHtmlContainsNode($view, '//select[@aria-describedby="input_oops_feedback"]');
        $this->assertHtmlContainsNode($view, '//*[@id="input_oops_feedback"]//*[contains(text(),"You really done it now")]');

        $this->assertHtmlDoesntContainNode($view, '//select[@error]');
    }

    public function test_it_can_add_attributes_to_the_group()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select name="bloober" :wrapperAttributes="[\'id\' => \'bloober_group\', \'class\' => \'mb-7\']" />');

        $this->assertHtmlContainsNode($view, '//*[@id="bloober_group"]//select[@name="bloober"]');

        $this->assertHtmlContainsNode($view, '//*[' . $this->xpathCheckClass('mb-7') . ']//select[@name="bloober"]');
    }

    public function test_it_can_add_attributes_to_the_label()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select name="bloober" label="Bloober Team" :labelAttributes="[\'id\' => \'bloober_label\']" />');

        $this->assertHtmlContainsNode($view, '//label[@id="bloober_label"]');
    }

    public function test_it_can_add_attributes_to_the_input_group()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select name="bloober" :inputGroupAttributes="[\'id\' => \'bloober_special\', \'class\' => \'mb-11\']" />');

        $this->assertHtmlContainsNode($view, '//*[@id="bloober_special"]//select[@name="bloober"]');

        $this->assertHtmlContainsNode($view, '//*[' . $this->xpathCheckClass('mb-11') . ']//select[@name="bloober"]');
    }

    public function test_it_uses_the_grouping_name_when_multiple_is_passed()
    {
        // $this->markTestSkipped('Optgroups are not yet supported.');

        $view = $this->withViewErrors([])
            ->blade('<x-form::select name="categories" multiple  :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
                \'maybe\' => \'Maybe\',
            ]" />');

        $this->assertHtmlContainsNode($view, '//select[@name="categories[]"]');
    }

    public function test_it_prefills_correctly_when_multiple_is_passed()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select name="categories" multiple :options="[
                \'yes\' => \'Yes\',
                \'no\' => \'No\',
                \'maybe\' => \'Maybe\',
            ]" :value="[\'no\', \'maybe\']" />');

        $this->assertHtmlContainsNode($view, '//select/option[@value="no"][@selected]');
        $this->assertHtmlContainsNode($view, '//select/option[@value="maybe"][@selected]');
        $this->assertHtmlDoesntContainNode($view, '//select/option[@value="yes"][@selected]');
    }

    public function test_it_prefills_correctly_when_multiple_is_passed_and_optgroups_are_in_use()
    {
        $this->markTestSkipped('Optgroups are not yet supported.');
        
        $view = $this->withViewErrors([])
            ->blade('<x-form::select name="categories" multiple :options="[
                \'Finicky Options\' => [
                    \'yes\' => \'Yes\',
                    \'no\' => \'No\',
                    \'maybe\' => \'Maybe\',
                ]
            ]" :value="[\'no\', \'maybe\']" />');

        $this->assertHtmlContainsNode($view, '//select/optgroup/option[@value="no"][@selected]');
        $this->assertHtmlContainsNode($view, '//select/optgroup/option[@value="maybe"][@selected]');
        $this->assertHtmlDoesntContainNode($view, '//select/optgroup/option[@value="yes"][@selected]');
    }

    public function test_it_can_set_arbitrary_attributes_on_the_input()
    {
        $view = $this->withViewErrors([])
            ->blade('<x-form::select data-key="42" ::something-else="{\'success\':true}" />');

        $this->assertHtmlContainsNode($view, '//select[@data-key="42"]');

        $view->assertSeeInOrder([
            '<select',
            ':something-else="{\'success\':true}"',
            '>',
            '</select>',
        ], false);
    }
}