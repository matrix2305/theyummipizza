<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\DataAccess;


use Doctrine\ORM\EntityManagerInterface;
use Yummi\Application\Contracts\ILog;
use Yummi\Application\Contracts\Repositories\IContentRepository;
use Yummi\Domain\Entities\Content;

class ContentRepository extends BaseRepository implements IContentRepository
{
    private string $content;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        parent::__construct($em, $log);
        $this->content = Content::class;
    }

    public function updateContent(Content $content, $version = null): void
    {
        $this->addOrUpdate($content, $version);
    }

    public function getContent(): Content
    {
        $content = $this->getAll($this->content);
        return $content[0];
    }
}