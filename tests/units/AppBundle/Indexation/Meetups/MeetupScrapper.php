<?php

namespace AppBundle\Indexation\Meetups\tests\units;

use AppBundle\Indexation\Meetups\MeetupScraper as TestedClass;
use atoum;

class MeetupScraper extends atoum
{
    /**
     * @param string $antenneUrl
     *
     * @dataProvider invalidMeetupUrlProvider
     */
    public function testGetDomContentWithInvalidMeetupUrl($antenneUrl)
    {
        $meetupScraper = new TestedClass();

        $baseUrl = TestedClass::MEETUP_URL;
        $url = $baseUrl. $antenneUrl;

        $this
            ->exception(function () use ($meetupScraper, $antenneUrl) {
                $meetupScraper->getDomContent($antenneUrl);
            })
            ->isInstanceOf(\Exception::class)
            ->hasMessage(sprintf('Antenne url icorrecte %s', $url));
    }

    /**
     * @param string $antenneUrl
     *
     * @dataProvider validMeetupUrlProvider
     */
    public function testGetDomContentWithValidMeetupUrl($antenneUrl)
    {
        $meetupScraper = new TestedClass();
        $xpath = $meetupScraper->getDomContent($antenneUrl);

        $this
            ->object($xpath)
            ->isInstanceOf(\DOMXPath::class);
    }

    /**
     * @throws \Exception
     */
    public function testGetMeetupEvents()
    {
        $meetupScraper = new TestedClass();
        $events = $meetupScraper->getEvents();

        $eventLength = count($events);

        $this
            ->integer($eventLength)
            ->isGreaterThan(0);
    }

    /**
     * @throws \Exception
     */
    public function testGetAntennesFromOfficesCollection()
    {
        $meetupScraper = new TestedClass();
        $antennes = $meetupScraper->getAntennesFromOfficesCollection();

        $this
            ->array($antennes)
            ->isNotEmpty();
    }

    public function testGetArrayValueByKey()
    {
        $meetupScraper = new TestedClass();
        $array = ['key' => 'value'];
        $result = $meetupScraper->getArrayValueByKey('key', $array);

        $this
            ->string($result)
            ->isEqualTo('value');
    }

    // Provide valid Meetup URLs for testing
    protected function validMeetupUrlProvider()
    {
        return [
            ['Bordeaux-PHP-Meetup'],
            ['afup-lyon-php'],
        ];
    }

    // Provide invalid Meetup URLs for testing
    protected function invalidMeetupUrlProvider()
    {
        return [
            ['invalid-url-1'],
            ['invalid-url-2'],
            ['afuep-lyon-phpe'],
        ];
    }
}
