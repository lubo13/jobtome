<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\RedirectionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RedirectionRepository::class)
 */
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
    routePrefix: '/api',
)]
#[ApiFilter(SearchFilter::class, properties: ['url.id' => 'exact', 'url.origin' => 'partial'])]
class Redirection
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $counter = 0;

    /**
     * @ORM\OneToOne(targetEntity=Url::class, inversedBy="redirection", cascade={"persist", "remove"})
     */
    private Url $url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCounter(): ?int
    {
        return $this->counter;
    }

    public function setCounter(int $counter): self
    {
        $this->counter = $counter;

        return $this;
    }

    public function incrementCounter(): self
    {
        ++$this->counter;

        return $this;
    }

    public function getUrl(): ?Url
    {
        return $this->url;
    }

    public function setUrl(Url $url): self
    {
        $this->url = $url;

        return $this;
    }
}
