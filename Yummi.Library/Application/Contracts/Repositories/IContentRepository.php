<?php
declare(strict_types=1);
namespace Yummi\Application\Contracts\Repositories;


use Yummi\Domain\Entities\Content;

interface IContentRepository
{
    public function updateContent(Content $content, $version = null): void;

    public function getContent() : Content;
}