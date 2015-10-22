<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentVote
 *
 * @ORM\Table(name="comment_vote")
 * @ORM\Entity
 */
class CommentVote
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
     * @var Comment
     *
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="votes")
     */
    private $comment;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="votes")
     */
    private $user;

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
     * Set comment
     *
     * @param \AppBundle\Entity\Comment $comment
     * @return CommentVote
     */
    public function setComment(\AppBundle\Entity\Comment $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return \AppBundle\Entity\Comment 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return CommentVote
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
}
