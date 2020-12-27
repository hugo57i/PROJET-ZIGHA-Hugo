<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id_Utilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=256, nullable=false)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=256, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=256, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=256, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=256, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasse", type="string", length=256, nullable=false)
     */
    private $motDePasse;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=256, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=256, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=16, nullable=false)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=256, nullable=false)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=256, nullable=false)
     */
    private $telephone;


    /**
     * Get idUtilisateur.
     *
     * @return int
     */
    public function getIdUtilisateur()
    {
        return $this->id_Utilisateur;
    }

    /**
     * Set civilite.
     *
     * @param string $civilite
     *
     * @return Utilisateur
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite.
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Utilisateur
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
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set login.
     *
     * @param string $login
     *
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set motDePasse.
     *
     * @param string $motDePasse
     *
     * @return Utilisateur
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse.
     *
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set adresse.
     *
     * @param string $adresse
     *
     * @return Utilisateur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville.
     *
     * @param string $ville
     *
     * @return Utilisateur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codePostal.
     *
     * @param string $codePostal
     *
     * @return Utilisateur
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal.
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set pays.
     *
     * @param string $pays
     *
     * @return Utilisateur
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays.
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set telephone.
     *
     * @param string $telephone
     *
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone.
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}