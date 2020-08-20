<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;


use Doctrine\ORM\EntityManagerInterface;
use Yummi\Application\Contracts\ILog;
use Yummi\Application\Contracts\Repositories\ISaladsRepository;
use Yummi\Domain\Entities\Salad;

class SaladsRepository extends BaseRepository implements ISaladsRepository
{
    private string $salad;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        parent::__construct($em, $log);
        $this->salad = Salad::class;
    }

    public function getAllSalads() : array
    {
        return $this->getAll($this->salad);
    }

    public function getOneSalad(string $id) : Salad
    {
        return $this->getOne($this->salad, $id);
    }

    public function addOrUpdateSalad(Salad $salad, $version = null) : void
    {
        $this->addOrUpdate($salad, $version);
    }

    public function deleteSalad(Salad $salad) : void
    {
        $this->remove($salad);
    }
}