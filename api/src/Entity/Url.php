<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UrlRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UrlRepository::class)
 * @UniqueEntity(
 *     fields={"origin", "location"},
 *     message="Combinatipn from this origin and location is already exist."
 * )
 * @ORM\HasLifecycleCallbacks()
 */
#[ApiResource(
    collectionOperations: [
    'get',
    'post',
],
    itemOperations: [
    'get',
    'put',
    'delete',
],
    denormalizationContext: [
    'groups' => [
        'write',
    ],
],
    normalizationContext: [
    'groups' => [
        'read',
    ],
],
    routePrefix: '/api',
)]
class Url
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read", "write")
     */
    private string $origin;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read", "write")
     */
    private string $location;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("read")
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("read")
     */
    private DateTime $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=Redirection::class, mappedBy="url", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups("read")
     */
    private ?Redirection $redirection = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(): void
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function preUpdate(): void
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @return ?\App\Entity\Redirection
     */
    public function getRedirection(): ?Redirection
    {
        return $this->redirection;
    }

    /**
     * @param \App\Entity\Redirection $redirection
     */
    public function setRedirection(Redirection $redirection): void
    {
        $this->redirection = $redirection;
    }
}
