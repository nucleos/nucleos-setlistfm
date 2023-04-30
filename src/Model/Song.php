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
final class Song
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $info;

    /**
     * @var Artist|null
     */
    private $cover;

    /**
     * @var bool
     */
    private $taped;

    /**
     * @var Artist[]
     */
    private $featurings;

    /**
     * @param Artist[] $featurings
     */
    public function __construct(string $name, ?string $info, ?Artist $cover, bool $taped, array $featurings)
    {
        $this->name       = $name;
        $this->info       = $info;
        $this->cover      = $cover;
        $this->taped      = $taped;
        $this->featurings = $featurings;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function getCover(): ?Artist
    {
        return $this->cover;
    }

    public function isTaped(): bool
    {
        return $this->taped;
    }

    /**
     * @return Artist[]
     */
    public function getFeaturings(): array
    {
        return $this->featurings;
    }

    public static function fromApi(array $data): self
    {
        $featuring = [];

        if (isset($data['with'])) {
            $featuring[] = Artist::fromApi($data['with']);
        }

        return new self(
            $data['name'],
            $data['info'] ?? null,
            isset($data['cover']) ? Artist::fromApi($data['cover']) : null,
            isset($data['tape']) ? (bool) $data['tape'] : false,
            $featuring
        );
    }
}
