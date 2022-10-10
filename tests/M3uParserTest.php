<?php

declare(strict_types=1);

use dsv\m3u8Parser\M3uParser;
use PHPUnit\Framework\TestCase;

class M3uParserTest extends TestCase
{
    public function testM3uParser(): void
    {
        $m3uParser = new M3uParser();

        $m3uParser->setM3uFile(__DIR__ . '/testfile.m3u8');

        $this->assertEquals(
            [
                0 =>
                    new dsv\m3u8Parser\Dto\M3uItem([
                        'extInfs' =>
                            [
                                0 =>
                                    new dsv\m3u8Parser\Dto\ExtXInfDto(
                                        '#EXT-X-AVAILABLE-UNTIL-DATE-TIME',
                                        '2010-02-19T14:54:23.031+08:00',
                                    ),
                            ],
                        'id' => null,
                        'name' => 'BigBuckBunny - BigBuckBunny',
                        'groupName' => null,
                        'logo' => 'cover.jpg',
                        'country' => null,
                        'language' => null,
                        'url' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
                        'userAgent' => null,
                    ]),
                1 =>
                    new dsv\m3u8Parser\Dto\M3uItem([
                        'extInfs' =>
                            [
                                0 =>
                                    new dsv\m3u8Parser\Dto\ExtXInfDto(
                                        '#EXT-X-AVAILABLE-UNTIL-DATE-TIME',
                                        '2010-02-19T14:54:23.031+08:00',
                                    ),
                            ],
                        'id' => null,
                        'name' => 'ElephantsDream - ElephantsDream',
                        'groupName' => null,
                        'logo' => null,
                        'country' => null,
                        'language' => null,
                        'url' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
                        'userAgent' => null,
                    ]),
            ]
            , $m3uParser->parse()
        );
    }
}
