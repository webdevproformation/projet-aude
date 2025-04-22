<?php 

namespace App\Entity ;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping As ORM ; 
use Symfony\Component\Validator\Constraints as Assert;

# https://www.doctrine-project.org/projects/doctrine-orm/en/3.3/reference/basic-mapping.html#basic-mapping

#[ORM\Entity()]
#[ORM\HasLifecycleCallbacks()]
class Requete {

    #[ORM\Id]  // clé primaire
    #[ORM\GeneratedValue()] // AutoIncrement
    #[ORM\Column()]
    private ?int $id = null ;

    #[ORM\Column()]
          // le champ est OBLIGATOIRE sinon la bdd la refuse =>
        // et au maximum il ya 255 caractères 
        // DATETIME NOT NULL 
    private ?\DateTime $created_at = null ;

    #[ORM\Column()]
      // le champ est OBLIGATOIRE sinon la bdd la refuse =>
        // et au maximum il ya 255 caractères 
        // VARCHAR(255) NOT NULL 
    #[Assert\Length(
            min: 2, 
            max: 50, 
            minMessage: "au minimum 2 lettres" , 
            maxMessage: "blabla"
    )]
    private ?string $type = null ;

    #[ORM\Column(nullable:true )] // accepte de créer des requetes sans deadline
                                  // dans la table tu acceptes que la valeur de ce champ soit NULL 
    private  ?\DateTime $deadline = null ;

    #[ORM\Column()] 
        // le champ est OBLIGATOIRE sinon la bdd la refuse =>
        // et au maximum il ya 255 caractères 
        // VARCHAR(255) NOT NULL 
    private ?string $title = null ;

    #[ORM\Column(nullable:true , type: 'text')]
                                 // le champ accepte la valeur null (par défaut) ET si il contient du texte il a pour valeur maximum 65 000 caractères 
    private ?string $description = null ;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'requetes')]
    private Collection $genres;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'requetes')]
    private ?Membre $membre = null;

    #[ORM\PrePersist()]
    public function actionBeforePersist()
    {
        // cette fonction va être exécuté automatiquement par Doctrine 
        // AVANT de faire le persist()
        $this->created_at = new DateTime(); 
    }

    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addRequete($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeRequete($this);
        }

        return $this;
    } 

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of deadline
     */ 
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set the value of deadline
     *
     * @return  self
     */ 
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($created_at) :static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): static
    {
        $this->membre = $membre;

        return $this;
    }
}