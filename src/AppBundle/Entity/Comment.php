<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * 
     * @Assert\NotBlank(message="Proszę wprowadzić treść komentarza.")
     * @Assert\Length(min=15, minMessage="Komentarz musi posiadać conajmniej {{ limit }} znaków.")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbVoteUp", type="smallint")
     */
    private $nbVoteUp = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbVoteDown", type="smallint")
     */
    private $nbVoteDown = 0;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="verified", type="boolean")
     */
    private $verified = false;
    
    /**
     * @var Product
     * 
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="comments")
     */
    private $product;
    
    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     */
    private $user;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CommentVote", mappedBy="comment")
     */
    private $votes;

    public function __construct()
    {
        $this->createdAt = new \DateTime("now");
        $this->votes = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Comment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set nbVoteUp
     *
     * @param integer $nbVoteUp
     * @return Comment
     */
    public function setNbVoteUp($nbVoteUp)
    {
        $this->nbVoteUp = $nbVoteUp;

        return $this;
    }

    /**
     * Get nbVoteUp
     *
     * @return integer 
     */
    public function getNbVoteUp()
    {
        return $this->nbVoteUp;
    }

    /**
     * Set nbVoteDown
     *
     * @param integer $nbVoteDown
     * @return Comment
     */
    public function setNbVoteDown($nbVoteDown)
    {
        $this->nbVoteDown = $nbVoteDown;

        return $this;
    }

    /**
     * Get nbVoteDown
     *
     * @return integer 
     */
    public function getNbVoteDown()
    {
        return $this->nbVoteDown;
    }

    /**
     * Set verified
     *
     * @param boolean $verified
     * @return Comment
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return boolean 
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return Comment
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add votes
     *
     * @param \AppBundle\Entity\CommentVote $votes
     * @return Comment
     */
    public function addVote(\AppBundle\Entity\CommentVote $votes)
    {
        $this->votes[] = $votes;

        return $this;
    }

    /**
     * Remove votes
     *
     * @param \AppBundle\Entity\CommentVote $votes
     */
    public function removeVote(\AppBundle\Entity\CommentVote $votes)
    {
        $this->votes->removeElement($votes);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->votes;
    }
}
