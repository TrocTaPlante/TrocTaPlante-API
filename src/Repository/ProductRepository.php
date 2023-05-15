<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllWithUser(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p', 'u', 'g')
            ->leftJoin('p.user', 'u')
            ->leftJoin('p.genus', 'g')
            ->getQuery()
            ->getResult();
    }

    public function updateProduct(Product $product): int
    {

        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->update()
            ->set('p.quantity', ':quantity')
            ->set('p.state', ':state')
            ->set('p.height', ':height')
            ->set('p.pot_height', ':pot_height')
            ->set('p.pot_width', ':pot_width')
            ->set('p.species', ':species')
            ->where('p.id = :id')
            ->setParameter('id', $product->getId())
            ->setParameter('quantity', $product->getQuantity())
            ->setParameter('state', $product->getState())
            ->setParameter('height', $product->getHeight())
            ->setParameter('pot_height', $product->getPotHeight())
            ->setParameter('pot_width', $product->getPotWidth())
            ->setParameter('species', $product->getSpecies());

        $query = $queryBuilder->getQuery();
        return $query->execute();
    }

    public function findBySearchQuery(string $searchQuery, int $limit = 10): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.species LIKE :searchQuery')
            ->setParameter('searchQuery', '%' . $searchQuery . '%')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
