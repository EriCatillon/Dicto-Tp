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
     * @ORM\Column(name="the_word", type="string", length=255)
     */
    private $the_word;

    /**
     * @var string
     *
     * @ORM\Column(name="definition", type="string", length=255)
     */
    private $definition;

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
        $this->the_word = $theWord;

        return $this;
    }

    /**
     * Get the_word
     *
     * @return string 
     */
    public function getTheWord()
    {
        return $this->the_word;
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
}