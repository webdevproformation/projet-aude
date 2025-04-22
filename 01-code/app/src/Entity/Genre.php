<?php 

namespace App\Entity ;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping As ORM ; 

#[ORM\Entity()]
class Genre{

    #[ORM\Id]  // clé primaire
    #[ORM\GeneratedValue()] // AutoIncrement
    #[ORM\Column()]
    private ?int $id = null ;

    #[ORM\Column()]
    private ?string $name = null ; 

    #[ORM\Column(options:["default"=> "CURRENT_TIMESTAMP"])]
    private ?\DateTime $created_at = null ;

    /**
     * @var Collection<int, Requete>
     */
    #[ORM\ManyToMany(targetEntity: Requete::class, inversedBy: 'genres')]
    private Collection $requetes;

    public function __construct()
    {
        $this->requetes = new ArrayCollection();
    }

    /**
     * @return Collection<int, Requete>
     */
    public function getRequetes(): Collection
    {
        return $this->requetes;
    }

    public function addRequete(Requete $requete): static
    {
        if (!$this->requetes->contains($requete)) {
            $this->requetes->add($requete);
        }

        return $this;
    }

    public function removeRequete(Requete $requete): static
    {
        $this->requetes->removeElement($requete);

        return $this;
    }
    
    public function getId(): ?int
    {
        return $this->id ; 
    }

    public function getCreatedAt() : ?\DateTime
    {
        return $this->created_at ; 
    }


    public function getName(): ?string
    {
        return $this->name ;
    }

    public function setName(?string $valeur)
    {
        $this->name  = $valeur ; 
    }
}