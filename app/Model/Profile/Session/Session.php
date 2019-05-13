<?php declare(strict_types=1);

namespace Snipcode\Entity;

use Snipcode\Model\Snippet\Snippet;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="session", indexes={@ORM\Index(name="search_index", columns={"hash"})})
 * @ORM\HasLifecycleCallbacks
 */
class Session
{
    use UniqueTrait;
    use DateTimeTrait;

    /**
     * @ORM\Column(type="string", length=26, unique=true)
     * @var string
     */
    protected $hash;

    /**
     * Many Sessions have One IpAddress
     * @ORM\ManyToOne(targetEntity="IpAddress", inversedBy="session", cascade={"persist"})
     * @var IpAddress
     */
    protected $ipAddress;

    /**
     * One Session has Many Snippets
     * @ORM\OneToMany(targetEntity="\Snipcode\Model\Snippet\Snippet", mappedBy="author_session", cascade={"persist", "remove"})
     * @var Snippet[]
     */
    protected $snippets;

    /**
     * Session constructor.
     * @param string $hash
     * @param IpAddress $ip_address
     */
    public function __construct(string $hash, IpAddress $ip_address)
    {
        $this->hash = $hash;
        $this->ipAddress = $ip_address;
        $this->snippets = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return IpAddress
     */
    public function getIpAddress(): IpAddress
    {
        return $this->ipAddress;
    }

    /**
     * @param IpAddress $ip_address
     */
    public function changeIpAddress(IpAddress $ip_address): void
    {
        $this->ipAddress = $ip_address;
    }

    /**
     * @return Snippet[]
     */
    public function getSnippets()
    {
        return $this->snippets;
    }

    /**
     * @param Snippet $snippet
     */
    public function addSnippet(Snippet $snippet): void
    {
        $this->snippets->add($snippet);
    }
}