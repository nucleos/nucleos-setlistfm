<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\SetlistFm\Builder;

use InvalidArgumentException;

final class ArtistSearchBuilder
{
    /**
     * @var array
     */
    private $query;

    private function __construct()
    {
        $this->query = [];

        $this->page(1);
    }

    public static function create(): self
    {
        return new static();
    }

    public function page(int $page): self
    {
        $this->query['p'] = $page;

        return $this;
    }

    public function sort(string $mode): self
    {
        if (!\in_array($mode, ['sortName', 'relevance'], true)) {
            throw new InvalidArgumentException(sprintf('Invalid sort mode given: %s', $mode));
        }

        $this->query['sort'] = $mode;

        return $this;
    }

    public function withName(string $name): self
    {
        $this->query['artistName'] = $name;

        return $this;
    }

    public function withMbid(string $mbid): self
    {
        $this->query['artistMbid'] = $mbid;

        return $this;
    }

    public function withTmbid(int $tmid): self
    {
        $this->query['artistTmid'] = $tmid;

        return $this;
    }

    public function getQuery(): array
    {
        return $this->query;
    }
}
