<?php

namespace 'App\Entity';

use Doctrine\ORM\Mapping as ORM;

/**
 * Borrow
 *
 * @ORM\Table(name="borrow", indexes={@ORM\Index(name="IDX_55DBA8B016A2B381", columns={"book_id"}), @ORM\Index(name="IDX_55DBA8B0A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_55DBA8B0610C473A", columns={"box_from_id"}), @ORM\Index(name="IDX_55DBA8B0491F968D", columns={"box_to_id"})})
 * @ORM\Entity
 */
class Borrow
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date", nullable=false)
     */
    private $dateStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @var \Book
     *
     * @ORM\ManyToOne(targetEntity="Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     * })
     */
    private $book;

    /**
     * @var \Box
     *
     * @ORM\ManyToOne(targetEntity="Box")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="box_to_id", referencedColumnName="id")
     * })
     */
    private $boxTo;

    /**
     * @var \Box
     *
     * @ORM\ManyToOne(targetEntity="Box")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="box_from_id", referencedColumnName="id")
     * })
     */
    private $boxFrom;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
