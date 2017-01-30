<?php
/**
 * Created by PhpStorm.
 * User: Skolem
 * Date: 2017. 01. 23.
 * Time: 19:10
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="questions")
 */
class Questions
{


    /**
     * @ORM\Id
     * @ORM\Column(name="qId", type="integer" )
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $qId;

    /**
     * @ORM\Column(name="shortQuestion", type="text", length=100)
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Biztos ilyen rövid a kérdésed? Csak {{ limit }} karakteres",
     *      maxMessage = "Biztos ilyen hosszú a kérdésed? {{ limit }} karakteres :o "
     * )
     */
    private $shortQuestion;

    /**
     * @ORM\Column(name="longQuestion", type="text")
     * @Assert\Length(
     *      max = 500,
     *      maxMessage = "Sok lesz! Tömörebben! Max 500 karakteres lehet!"
     * )
     */
    private $longQuestion = "A felhasználó nem részletezi #aA9QvjF7zd";

    /**
     * @ORM\Column(name="qTime", type="datetime")
     */
    private $qTime;


    /**
     * One Question has Many Answers.
     * @ORM\OneToMany(targetEntity="Answers", mappedBy="questionId")
     */
    private $answers;

    public function __construct()
    {
        $this->qTime = new \DateTime('now');
        $this->answers = new ArrayCollection();
    }


    /**
     * Get qId
     *
     * @return integer
     */
    public function getQId()
    {
        return $this->qId;
    }

    /**
     * Set shortQuestion
     *
     * @param string $shortQuestion
     *
     * @return Questions
     */
    public function setShortQuestion($shortQuestion)
    {
        $this->shortQuestion = $shortQuestion;

        return $this;
    }

    /**
     * Get shortQuestion
     *
     * @return string
     */
    public function getShortQuestion()
    {
        return $this->shortQuestion;
    }

    /**
     * Set longQuestion
     *
     * @param string $longQuestion
     *
     * @return Questions
     */
    public function setLongQuestion($longQuestion)
    {
        $this->longQuestion = $longQuestion;

        return $this;
    }

    /**
     * Get longQuestion
     *
     * @return string
     */
    public function getLongQuestion()
    {
        return $this->longQuestion;
    }

    /**
     * Set qTime
     *
     * @param \DateTime $qTime
     *
     * @return Questions
     */
    public function setQTime($qTime)
    {
        $this->qTime = $qTime;

        return $this;
    }

    /**
     * Get qTime
     *
     * @return \DateTime
     */
    public function getQTime()
    {
        return $this->qTime;
    }

    /**
     * Add answer
     *
     * @param \AppBundle\Entity\Answers $answer
     *
     * @return Questions
     */
    public function addAnswer(\AppBundle\Entity\Answers $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \AppBundle\Entity\Answers $answer
     */
    public function removeAnswer(\AppBundle\Entity\Answers $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
