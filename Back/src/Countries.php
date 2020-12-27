<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Countries
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity
 */
class Countries
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=128, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="dial_code", type="string", length=16, nullable=false)
     */
    private $dialCode;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=8, nullable=false)
     */
    private $code;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Countries
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dialCode.
     *
     * @param string $dialCode
     *
     * @return Countries
     */
    public function setDialCode($dialCode)
    {
        $this->dialCode = $dialCode;

        return $this;
    }

    /**
     * Get dialCode.
     *
     * @return string
     */
    public function getDialCode()
    {
        return $this->dialCode;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Countries
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
