<?php

namespace Bell\Console\Services;

use Bell\Console\Interfaces\GoutteClientInterface;
use Bell\Console\Interfaces\ScraperInterface;
use Bell\Console\Interfaces\StorageInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class HawksNewsScraper
 *
 * @package Bell\Console\Services
 */
class HawksNewsScraper implements ScraperInterface
{
    /** @var string */
    private const NEWS_URI = 'https://www.softbankhawks.co.jp/news/list/index.html';

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
        $crawler = $this->client->request('GET', self::NEWS_URI);
        $articles = $crawler->filter('section > .pl_newsList02 > li');

        $articles->eq(0)->each(function (Crawler $node) use ($storage) {
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
