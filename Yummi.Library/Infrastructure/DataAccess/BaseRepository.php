<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;

use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use RuntimeException;
abstract class BaseRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function getAll(string $class) : array
    {
        return $this->em->getRepository($class)->findBy([],['id' => 'DESC']);
    }

    public function getOne(string $class, string $id) : object
    {
        return $this->em->getRepository($class)->find($id);
    }

    public function addOrUpdate(object $object, int $version) : void
    {
        $this->em->getConnection()->beginTransaction();
        try {
            try {
                $this->em->lock($object, LockMode::OPTIMISTIC, $version);
            }catch (OptimisticLockException $exception){
                throw new RuntimeException('Sorry, but someone else already execute changes. Please apply changes again!');
            }
            $this->em->getUnitOfWork()->clear();
            $this->em->getUnitOfWork()->persist($object);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            throw $exception;
        }
    }

    public function remove(object $object) : void
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->remove($object);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            throw $exception;
        }
    }
}