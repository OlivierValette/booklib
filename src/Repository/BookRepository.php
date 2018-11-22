<?php

namespace App\Repository;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }
    
    /** List the $limit firsts books of the author $author
     * @param Author    $author
     * @param int       $limit
     * @param Book|null $book
     * @return array of Book objects
     */
    public function findFirstsAuthorBooks(Author $author, int $limit, Book $book = null): array
    {
        $qb = $this->createQueryBuilder('b');
        
        $qb = $qb->innerJoin('b.author', 'a')
            ->where($qb->expr()->eq('a.id', ':author'));
    
        if ($book != null) {
            $qb = $qb->andWhere($qb->expr()->neq('b.id', ':book'))
                ->setParameter(':book', $book->getId());
        }
        
        return $qb->setParameter(':author', $author->getId())
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
    
    /** List the $limit last created books
     * @param int $limit
     * @return array
     */
    public function findLast(int $limit): array
    {
        $qb = $this->createQueryBuilder('b');
        // inner join with Author for number of queries optimization purpose
        $qb = $qb->select('b', 'a')->innerJoin('b.author','a')
            ->orderBy('b.createdAt', 'DESC')->setMaxResults($limit);
            
        return $qb->getQuery()->getResult();
    }
}
