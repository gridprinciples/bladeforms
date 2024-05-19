<?php

namespace GridPrinciples\BladeForms\Tests;

use Illuminate\View\ViewException;

class FormTest extends TestCase
{
    public function test_it_sets_a_default_method()
    {
        $this->withViewErrors([]);

        $output = $this->blade('<x-form />');

        $this->assertHtmlContainsNode($output, '//form[@method="POST"]');
    }

    public function test_it_adds_multipart_attribute()
    {
        $output = $this->blade('<x-form multipart />');

        $this->assertHtmlContainsNode($output, '//form[@enctype="multipart/form-data"]');
    }

    public function test_it_adds_csrf_field()
    {
        $output = $this->blade('<x-form />');

        $this->assertHtmlContainsNode($output, '//input[@name="_token"]');
    }

    public function test_it_doesnt_add_csrf_field()
    {
        $output = $this->blade('<x-form :csrf="false" />');

        $this->assertHtmlDoesntContainNode($output, '//input[@name="_token"]');
    }

    public function test_it_works_via_get_shortcut()
    {
        $output = $this->blade('<x-form get="/search" />');

        $this->assertHtmlContainsNode($output, '//form[@method="GET"][@action="/search"]');
        $this->assertHtmlDoesntContainNode($output, '//input[@name="_method"]');
    }

    public function test_it_works_via_post_shortcut()
    {
        $output = $this->blade('<x-form post="/search" />');

        $this->assertHtmlContainsNode($output, '//form[@method="POST"][@action="/search"]');
        $this->assertHtmlDoesntContainNode($output, '//input[@name="_method"]');
    }

    public function test_it_works_via_put_shortcut()
    {
        $output = $this->blade('<x-form put="/search" />');

        $this->assertHtmlContainsNode($output, '//form[@method="POST"][@action="/search"]');
        $this->assertHtmlContainsNode($output, '//input[@name="_method"][@value="PUT"]');
    }

    public function test_it_works_via_patch_shortcut()
    {
        $output = $this->blade('<x-form patch="/search" />');

        $this->assertHtmlContainsNode($output, '//form[@method="POST"][@action="/search"]');
        $this->assertHtmlContainsNode($output, '//input[@name="_method"][@value="PATCH"]');
    }

    public function test_it_works_via_delete_shortcut()
    {
        $output = $this->blade('<x-form delete="/search" />');

        $this->assertHtmlContainsNode($output, '//form[@method="POST"][@action="/search"]');
        $this->assertHtmlContainsNode($output, '//input[@name="_method"][@value="DELETE"]');
    }

    public function test_it_throws_exception_on_overstuffed_properties()
    {
        $this->expectException(ViewException::class);
        $this->expectExceptionMessage('You cannot use both the action attribute and a shortcut method attribute.');

        $this->blade('<x-form action="/search" post="/search" />');
    }
}
