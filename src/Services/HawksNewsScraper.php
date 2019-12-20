<?php

namespace Bell\Console\Services;

use Bell\Console\Interfaces\GoutteClientInterface;
use Bell\Console\Interfaces\ScraperInterface;
use Bell\Console\Interfaces\StorageInterface;
use Closure;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class HawksNewsScraper
 *
 * @package Bell\Console\Services
 */
class HawksNewsScraper implements ScraperInterface
{
    /** @var GoutteClientInterface */
    private $client;

    /**
     * {@inheritDoc}
     */
    public function __construct(GoutteClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function scraping(StorageInterface $storage)
    {
        $crawler = $this->client->request('GET', 'https://www.softbankhawks.co.jp/news/list/index.html');
        $section = $crawler->filter('section');
        //$date = $section->filter('.pl_titleWrap03 > h2')->text();

        $section->filter('.pl_newsList02 > li')->eq(0)->each(function (Crawler $node) use ($storage) {
            $storage->append(
                [
                    'date' => $node->filter('.pl_date > p')->eq(0)->text() . '日',
                    'article' => $node->filter('ul > li')->each(function (Crawler $node) {
                        $pl_text = $node->filter('.pl_text');
                        $a = $pl_text->filter('a');
                        $link = $a->link();

                        return [
                            'label' => $pl_text->filter('.pl_labelIconBl01')->each(function (Crawler $node) {
                                return $node->text();
                            }),
                            'title' => $a->text(),
                            'description' => $this->client->click($link)
                                ->filterXPath('//meta[@name="description"]')
                                ->attr('content'),
                            '_links' => [
                                'self' => [
                                    'href' => $link->getUri(),
                                ],
                                'image' => [
                                    'href' => $node->filter('img')->image()->getUri()
                                ]
                            ],
                        ];
                    })
                ]
            );
        });
    }
}
