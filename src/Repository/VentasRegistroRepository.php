<?php

namespace App\Repository;

use App\Entity\VentasRegistro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method VentasRegistro|null find($id, $lockMode = null, $lockVersion = null)
 * @method VentasRegistro|null findOneBy(array $criteria, array $orderBy = null)
 * @method VentasRegistro[]    findAll()
 * @method VentasRegistro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VentasRegistroRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, VentasRegistro::class);
        $this->manager = $manager;
    }

    public function saveVentasRegistro($clientName, $dateAdd, $friendName, $deliveryAddress, $deliveryDate, $ammount, $phoneNumber, $status)
    {
        $newVentasRegistro = new VentasRegistro();

        $newVentasRegistro
            ->setClientName($clientName)
            ->setDateAdd(new \DateTime($dateAdd))
            ->setFriendName($friendName)
            ->setDeliveryAddress($deliveryAddress)
            ->setDeliveryDate(new \DateTime($deliveryDate))
            ->setAmmount($ammount)
            ->setPhoneNumber($phoneNumber)
            ->setStatus($status);

        $this->manager->persist($newVentasRegistro);
        $this->manager->flush();
    }

    public function updateVentasRegistro(VentasRegistro $ventasRegistro): VentasRegistro
    {
        $this->manager->persist($ventasRegistro);
        $this->manager->flush();

        return $ventasRegistro;
    }

    public function removeVentasRegistro(VentasRegistro $ventasRegistro)
    {
        $this->manager->remove($ventasRegistro);
        $this->manager->flush();
    }

    // /**
    //  * @return VentasRegistro[] Returns an array of VentasRegistro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VentasRegistro
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
