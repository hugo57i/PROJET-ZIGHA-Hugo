<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="f_id_product", columns={"id_produit"}), @ORM\Index(name="f_id_client", columns={"id_client"})})
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Commande", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommande;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;

    /**
     * @var \Products
     *
     * @ORM\ManyToOne(targetEntity="Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produit", referencedColumnName="id")
     * })
     */
    private $idProduit;


    /**
     * Get idCommande.
     *
     * @return int
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

      /**
     * Get idCommande.
     *
     * @return int
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }


    /**
     * Set quantite.
     *
     * @param int $quantite
     *
     * @return Orders
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite.
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set idClient.
     *
     * @param \Utilisateur|null $idClient
     *
     * @return Orders
     */
    public function setIdClient(\Utilisateur $idClient = null)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get idClient.
     *
     * @return \Utilisateur|null
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set idProduit.
     *
     * @param \Products|null $idProduit
     *
     * @return Orders
     */
    public function setIdProduit(\Products $idProduit = null)
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    /**
     * Get idProduit.
     *
     * @return \Products|null
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }
}
