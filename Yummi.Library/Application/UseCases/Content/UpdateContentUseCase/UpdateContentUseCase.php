<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Content\UpdateContentUseCase;


use Yummi\Application\Contracts\Repositories\IContentRepository;
use Yummi\Application\Contracts\UseCases\IUpdateContentUseCase;
use Yummi\Application\UseCases\Content\GetContentUseCase\GetContentOutput;
use Yummi\Domain\ValueObjects\Address;
use Yummi\Domain\ValueObjects\Email;
use Yummi\Domain\ValueObjects\Phone;

class UpdateContentUseCase implements IUpdateContentUseCase
{
    private IContentRepository $contentRepository;

    public function __construct(IContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function Execute() : void
    {
        $data = GetContentOutput::fromRequest();
        $content = $this->contentRepository->getContent();
        $content->setDescription($data->description);
        $phone = new Phone((int)$data->phone);
        $content->setPhone($phone);
        $address = new Address($data->street, $data->numberOfStreet, $data->town);
        $content->setAddress($address);
        $email = new Email($data->email);
        $content->setEmail($email);
        $this->contentRepository->updateContent($content);
    }
}