<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Cart;
use App\Entity\CartArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CartArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartArticle[]    findAll()
 * @method CartArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartArticle::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CartArticle $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CartArticle $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findArticleForCart(?Article $article, Cart $cart): ?CartArticle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.article = :article')
            ->andWhere('c.Cart = :cart')
            ->setParameter('article', $article)
            ->setParameter('cart', $cart)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?CartArticle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
