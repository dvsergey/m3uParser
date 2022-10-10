<?php

declare(strict_types=1);

namespace dsv\m3u8Parser;

use dsv\m3u8Parser\Dto\M3uItem;
use dsv\Pattern\Singleton\ISingleton;
use dsv\Pattern\Singleton\TSingleton;
use http\Exception\RuntimeException;

final class M3uParser implements ISingleton
{
    use TSingleton;

    private const EXT_X = '#EXT-X-';
    private const REGEX = '/#([a-zA-Z0-9\-_]+?):/';
    private string $m3uFile;

    /** @return M3uItem[] */
    public function parse(): array
    {
        $m3uItems = [];

        $raw = $this->getM3uRaw();
        $array = $this->prepareData($raw);

        foreach ($array as $item) {
            if (isset($item['EXTINF'])) {
                $extInf = ExtInfParser::parse($item['EXTINF'] ?? '');
                if ($extInf) {
                    $m3uData = (array) $extInf;
                    $extXInfs = [];
                    foreach ($item as $extXInf) {
                        if (str_starts_with($extXInf, self::EXT_X)) {
                            $extXInfs[] = ExtXInfParser::parse($extXInf);
                        }
                    }
                    $m3uData['extInfs'] = $extXInfs;

                    $groupName = ExtgrpParser::parse($item['EXTGRP'] ?? '');
                    if ($groupName) {
                        $m3uData['groupName'] = $groupName;
                    }

                    $userAgent = ExtvlcoptParser::parse($item['EXTVLCOPT'] ?? '');
                    if ($userAgent) {
                        $m3uData['userAgent'] = $userAgent;
                    }

                    $m3uData['url'] = $item['url'];

                    $m3uItems[] = M3uItem::fromArray($m3uData);
                }
            }
        }
        return $m3uItems;
    }

    private function getM3uRaw(): string
    {
        $stringContent = file_get_contents($this->m3uFile);
        if ($stringContent === false) {
            throw new RuntimeException('Could not read M3u file ' . $this->m3uFile);
        }
        return $stringContent;
    }

    private function prepareAttributes(string $raw): array|string
    {
        $raw = str_replace('tvg-', '', $raw);
        $raw = str_replace('group-title', 'groupName', $raw);
        return str_replace('user-agent', 'userAgent', $raw);
    }

    private function prepareData(string $raw): array
    {
        $raw = $this->prepareAttributes($raw);
        $array = explode("\n", $raw);

        $data = [];
        $i = 0;
        foreach ($array as $item) {
            $name = 'url';
            preg_match(self::REGEX, $item, $matches);
            if (isset($matches[1])) {
                $name = $matches[1];
            }
            if ($item) {
                $data[$i][$name] = $item;
            }
            if ($name == 'url') {
                $i++;
            }
        }

        return $data;
    }

    private function getM3uFile(): string
    {
        return $this->m3uFile;
    }

    public function setM3uFile(string $m3uFile): self
    {
        $this->m3uFile = $m3uFile;
        return $this;
    }

    /**
     * @param M3uItem[] $items
     */
    public function toM3u(array $items): string
    {
        $string = '#EXTM3U' . PHP_EOL . PHP_EOL;
        foreach ($items as $m3uItem) {
            $string .= $m3uItem->toM3uPart() . PHP_EOL;
        }

        return $string;
    }
}
