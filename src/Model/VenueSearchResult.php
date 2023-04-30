<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\SetlistFm\Model;

/**
 * @psalm-immutable
 */
final class VenueSearchResult
{
    /**
     * @var Venue[]
     */
    private $result;

    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $pageSize;

    /**
     * @var int
     */
    private $totalSize;

    /**
     * @param Venue[] $result
     */
    private function __construct(array $result, int $page, int $pageSize, int $totalSize)
    {
        $this->result    = $result;
        $this->page      = $page;
        $this->pageSize  = $pageSize;
        $this->totalSize = $totalSize;
    }

    /**
     * @return Venue[]
     */
    public function getResult(): array
    {
        return $this->result;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getTotalSize(): int
    {
        return $this->totalSize;
    }

    public function getLastPage(): int
    {
        return (int) ceil($this->totalSize / $this->pageSize);
    }

    public static function createEmpty(): self
    {
        return new self([], 0, 0, 0);
    }

    public static function fromApi(array $response): self
    {
        return new self(
            array_map(
                static function (array $data): Venue {
                    return Venue::fromApi($data);
                },
                $response['venue']
            ),
            (int) $response['page'],
            (int) $response['itemsPerPage'],
            (int) $response['total']
        );
    }
}
