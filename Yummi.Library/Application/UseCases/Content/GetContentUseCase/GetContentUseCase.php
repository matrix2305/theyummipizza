<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Content\GetContentUseCase;


use Yummi\Application\Contracts\Repositories\IContentRepository;
use Yummi\Application\Contracts\UseCases\IGetContentUseCase;

class GetContentUseCase implements IGetContentUseCase
{
    private IContentRepository $contentRepository;

    public function __construct(IContentRepository $contentRepository){
        $this->contentRepository = $contentRepository;
    }

    public function Execute() : GetContentOutput
    {
        $content = $this->contentRepository->getContent();
        return GetContentOutput::fromEntity($content);
    }
}