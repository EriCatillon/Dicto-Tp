<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Word
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\WordRepository")
 */
class Word
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
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="theWord", type="string", length=255)
     */
    private $theWord;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Filter", mappedBy="advert")
    * @ORM\JoinColumn(nullable=false)
    */
    private $filter;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Type", mappedBy="advert")
    * @ORM\JoinColumn(nullable=false)
    */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="definition", type="string", length=255)
     */
    private $definition;

    /**
     * @var string
     *
     * @ORM\Column(name="definition2", type="string", length=255)
     */
    private $definition2;

    /**
     * @var string
     *
     * @ORM\Column(name="definition3", type="string", length=255)
     */
    private $definition3;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pronunciation", type="string", length=255)
     */
    private $pronunciation;

    /**
     * @var string
     *
     * @ORM\Column(name="example", type="text")
     */
    private $example;

    /**
     * @var string
     *
     * @ORM\Column(name="origin", type="string", length=255)
     */
    private $origin;

    /**
     * @var string
     *
     * @ORM\Column(name="useOfWord", type="string", length=255)
     */
    private $useOfWord;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $vote;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

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
     * Set definition
     *
     * @param string $definition
     * @return Word
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return string 
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * Set pronunciation
     *
     * @param string $pronunciation
     * @return Word
     */
    public function setPronunciation($pronunciation)
    {
        $this->pronunciation = $pronunciation;

        return $this;
    }

    /**
     * Get pronunciation
     *
     * @return string 
     */
    public function getPronunciation()
    {
        return $this->pronunciation;
    }

    /**
     * Set example
     *
     * @param string $example
     * @return Word
     */
    public function setExample($example)
    {
        $this->example = $example;

        return $this;
    }

    /**
     * Get example
     *
     * @return string 
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * Set origin
     *
     * @param string $origin
     * @return Word
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set useOfWord
     *
     * @param string $useOfWord
     * @return Word
     */
    public function setUseOfWord($useOfWord)
    {
        $this->useOfWord = $useOfWord;

        return $this;
    }

    /**
     * Get useOfWord
     *
     * @return string 
     */
    public function getUseOfWord()
    {
        return $this->useOfWord;
    }

    /**
     * Set the_word
     *
     * @param string $theWord
     * @return Word
     */
    public function setTheWord($theWord)
    {
        $this->theWord = $theWord;

        return $this;
    }

    /**
     * Get the_word
     *
     * @return string 
     */
    public function getTheWord()
    {
        return $this->theWord;
    }

    /**
     * Set vote
     *
     * @param integer $vote
     * @return Word
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return integer 
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     * @return Word
     */
    public function setType(\AppBundle\Entity\Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filter = new \Doctrine\Common\Collections\ArrayCollection();
        $this->type = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Word
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Add filter
     *
     * @param \AppBundle\Entity\Filter $filter
     * @return Word
     */
    public function addFilter(\AppBundle\Entity\Filter $filter)
    {
        $this->filter[] = $filter;

        return $this;
    }

    /**
     * Remove filter
     *
     * @param \AppBundle\Entity\Filter $filter
     */
    public function removeFilter(\AppBundle\Entity\Filter $filter)
    {
        $this->filter->removeElement($filter);
    }

    /**
     * Get filter
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Add type
     *
     * @param \AppBundle\Entity\Type $type
     * @return Word
     */
    public function addType(\AppBundle\Entity\Type $type)
    {
        $this->type[] = $type;

        return $this;
    }

    /**
     * Remove type
     *
     * @param \AppBundle\Entity\Type $type
     */
    public function removeType(\AppBundle\Entity\Type $type)
    {
        $this->type->removeElement($type);
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Word
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set definition2
     *
     * @param string $definition2
     * @return Word
     */
    public function setDefinition2($definition2)
    {
        $this->definition2 = $definition2;

        return $this;
    }

    /**
     * Get definition2
     *
     * @return string 
     */
    public function getDefinition2()
    {
        return $this->definition2;
    }

    /**
     * Set definition3
     *
     * @param string $definition3
     * @return Word
     */
    public function setDefinition3($definition3)
    {
        $this->definition3 = $definition3;

        return $this;
    }

    /**
     * Get definition3
     *
     * @return string 
     */
    public function getDefinition3()
    {
        return $this->definition3;
    }
}
