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


/**
 * @ORM\Entity
 * @ORM\Table(name="answers")
 */
class Answers
{
    /**
     * @ORM\Id
     * @ORM\Column(name="aId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $aId;

    /**
     * @ORM\Column(name="answer", type="text")
     * @Assert\Length(
     *      min=1,
     *      max = 500,
     *      minMessage="Ne hagyd üresen!",
     *      maxMessage = "Sok lesz! Tömörebben! Max 500 karakteres lehet!"
     * )
     */
    private $answer;

    /**
     * @ORM\Column(name="aTime", type="datetime")
     */
    private $aTime;


    /**
     * Many Answers have One Question.
     * @ORM\ManyToOne(targetEntity="Questions", inversedBy="answers")
     * @ORM\JoinColumn(name="questionId", referencedColumnName="qId")
     */
    private $questionId;


    public function __construct()
    {
        $this->aTime = new \DateTime('now');
    }


    /**
     * Get aId
     *
     * @return integer
     */
    public function getAId()
    {
        return $this->aId;
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return Answers
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set aTime
     *
     * @param \DateTime $aTime
     *
     * @return Answers
     */
    public function setATime($aTime)
    {
        $this->aTime = $aTime;

        return $this;
    }

    /**
     * Get aTime
     *
     * @return \DateTime
     */
    public function getATime()
    {
        return $this->aTime;
    }

    /**
     * Set questionId
     *
     * @param \AppBundle\Entity\Questions $questionId
     *
     * @return Answers
     */
    public function setQuestionId(\AppBundle\Entity\Questions $questionId = null)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId
     *
     * @return \AppBundle\Entity\Questions
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }
}
