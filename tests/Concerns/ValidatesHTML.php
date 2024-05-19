<?php

namespace GridPrinciples\BladeForms\Tests\Concerns;

use Illuminate\View\View;
use Symfony\Component\DomCrawler\Crawler;

trait ValidatesHTML
{
    protected function xpathCheckClass(string $css_class)
    {
        return 'contains(concat(" ",normalize-space(@class)," ")," ' . trim($css_class) . ' ")';
    }

    protected function assertHtmlContainsNode(View|string $html, string $nodeQuery)
    {
        $crawler = with(new Crawler($html));

        $body = $crawler->filterXPath('//body');

        $this->assertThat(
            (bool) $body->filterXPath($nodeQuery)->count(),
            static::isTrue(),
            "The provided HTML should contain $nodeQuery:\n\n$html"
        );
    }

    protected function assertHtmlContainsNodeCount(View|string $html, string $nodeQuery, int $count)
    {
        $crawler = with(new Crawler($html));

        $body = $crawler->filterXPath('//body');

        $this->assertThat(
            (int) $body->filterXPath($nodeQuery)->count(),
            static::equalTo($count),
            "The provided HTML has the wrong amount of $nodeQuery:\n\n$html"
        );
    }

    protected function assertHtmlContainsOneNode(View|string $html, string $nodeQuery)
    {
        $this->assertHtmlContainsNodeCount($html, $nodeQuery, 1);
    }

    protected function assertHtmlDoesntContainNode(View|string $html, string $nodeQuery)
    {
        $crawler = with(new Crawler($html));

        $body = $crawler->filterXPath('//body');

        $this->assertThat(
            (bool) $body->filterXPath($nodeQuery)->count(),
            static::isFalse(),
            "The provided HTML should not contain $nodeQuery:\n\n$html"
        );
    }
}