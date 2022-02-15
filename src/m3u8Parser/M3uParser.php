<?php

namespace dsv\m3u8Parser;

use dsv\m3u8Parser\Dto\M3uItem;
use dsv\Pattern\Singleton\ISingleton;
use dsv\Pattern\Singleton\TSingleton;

final class M3uParser implements ISingleton
{
    use TSingleton;

    private string $m3uFile;
    private string $reg = '/#([a-zA-Z0-9\-\_]+?):/';
    /** @var M3uItem[] */
    public array $items = [];

    public function parse()
    {
        $raw = $this->getM3uRaw();
        $array = $this->prepareData($raw);

        foreach ($array as $item) {
            if (isset($item['EXTINF'])) {
                $extInf = ExtInfParser::parse($item['EXTINF'] ?? '');
                $groupName = ExtgrpParser::parse($item['EXTGRP'] ?? '');
                $userAgent = ExtvlcoptParser::parse($item['EXTVLCOPT'] ?? '');
                if ($extInf) {
                    $m3uData = (array)$extInf;
                    $m3uData['url'] = $item['url'];
                    if ($groupName) {
                        $m3uData['groupName'] = $groupName;
                    }
                    if ($userAgent) {
                        $m3uData['userAgent'] = $userAgent;
                    }
                    $this->items[] = new M3uItem($m3uData);
                }
            }
        }
        return $this->items;
    }

    private function getM3uRaw()
    {
        return file_get_contents($this->getM3uFile());
    }

    private function prepareAttributes($raw)
    {
        $raw = str_replace('tvg-', '', $raw);
        $raw = str_replace('group-title', 'groupName', $raw);
        $raw = str_replace('user-agent', 'userAgent', $raw);
        return $raw;
    }

    private function prepareData($raw): array
    {
        $raw = $this->prepareAttributes($raw);
        $array = explode("\n", $raw);

        $data = [];
        $i = 0;
        foreach ($array as $item) {
            $name = 'url';
            preg_match($this->reg, $item, $matches);
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


    /** @return string */
    private function getM3uFile(): string
    {
        return $this->m3uFile;
    }

    /** @param string $m3ufile
     * @return M3uParser
     */
    public function setM3uFile(string $m3uFile): self
    {
        $this->m3uFile = $m3uFile;
        return $this;
    }

}