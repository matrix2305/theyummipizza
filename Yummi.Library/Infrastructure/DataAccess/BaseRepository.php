<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;

use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Yummi\Application\Contracts\ILog;
use RuntimeException;
abstract class BaseRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    protected ILog $log;

    public function __construct(EntityManagerInterface $em, ILog $log){
        $this->em = $em;
        $this->log = $log;
    }

    public function getAll(string $class) : array
    {
        return $this->em->getRepository($class)->findBy([],['id' => 'DESC']);
    }

    public function getOne(string $class, string $id) : object
    {
        return  $this->em->find($class, $id);
    }

    public function addOrUpdate($object, $version = null) : void
    {
        if (!empty($version)){
            $this->em->getConnection()->beginTransaction();
            try {
                $this->em->lock($object, LockMode::OPTIMISTIC, $version);
                $this->em->persist($object);
                $this->em->flush();
                $this->em->getConnection()->commit();
            }catch (OptimisticLockException $e) {
                throw new RuntimeException('You have to refresh the page, some one made the changes before you.');
            }catch (ConnectionException $exception){
                $this->em->getConnection()->rollBack();
                $this->log->addLog($exception->getMessage());
            }
        }else{
            $this->em->getConnection()->beginTransaction();
            try {
                $this->em->persist($object);
                $this->em->flush();
                $this->em->getConnection()->commit();
            }catch (ConnectionException $exception){
                $this->em->getConnection()->rollBack();
                $this->log->addLog($exception->getMessage());
            }
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
            $this->log->addLog($exception->getMessage());
        }
    }
}