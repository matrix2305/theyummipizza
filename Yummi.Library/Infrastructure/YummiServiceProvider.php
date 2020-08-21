<?php
declare(strict_types=1);
namespace Yummi\Infrastructure;


use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;
use Yummi\Application\Contracts\Repositories\IContentRepository;
use Yummi\Application\Contracts\Repositories\IDrinksRepository;
use Yummi\Application\Contracts\Repositories\IOrderRepository;
use Yummi\Application\Contracts\Repositories\IPizzasRepository;
use Yummi\Application\Contracts\Repositories\ISaladsRepository;
use Yummi\Application\Contracts\Repositories\IUsersRepository;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateDrinkUseCase;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateOrdersUseCase;
use Yummi\Application\Contracts\UseCases\IAddOrUpdatePizzaUseCase;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateSaladUseCase;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateSideDishesUseCase;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateUserUseCase;
use Yummi\Application\Contracts\UseCases\IDeleteDrinkUseCase;
use Yummi\Application\Contracts\UseCases\IDeleteOrdersUseCase;
use Yummi\Application\Contracts\UseCases\IDeletePizzaUseCase;
use Yummi\Application\Contracts\UseCases\IDeleteSaladUseCase;
use Yummi\Application\Contracts\UseCases\IDeleteSideDishesUseCase;
use Yummi\Application\Contracts\UseCases\IDeleteUserUseCase;
use Yummi\Application\Contracts\UseCases\IGetContentUseCase;
use Yummi\Application\Contracts\UseCases\IGetDrinksUseCase;
use Yummi\Application\Contracts\UseCases\IGetOrdersUseCase;
use Yummi\Application\Contracts\UseCases\IGetPizzasUseCase;
use Yummi\Application\Contracts\UseCases\IGetSaladsUseCase;
use Yummi\Application\Contracts\UseCases\IGetSideDishesUseCase;
use Yummi\Application\Contracts\UseCases\IGetUsersUseCase;
use Yummi\Application\Contracts\UseCases\IUpdateContentUseCase;
use Yummi\Application\UseCases\Content\GetContentUseCase\GetContentUseCase;
use Yummi\Application\UseCases\Content\UpdateContentUseCase\UpdateContentUseCase;
use Yummi\Application\UseCases\Drinks\AddOrUpdateDrinkUseCase\AddOrUpdateDrinkUseCase;
use Yummi\Application\UseCases\Drinks\DeleteDrinkUseCase\DeleteDrinkUseCase;
use Yummi\Application\UseCases\Drinks\GetDrinksUseCase\GetDrinksUseCase;
use Yummi\Application\UseCases\Orders\AddOrUpdateOrdersUseCase\AddOrUpdateOrdersUseCase;
use Yummi\Application\UseCases\Orders\AddOrUpdateSideDishesUseCase\AddOrUpdateSideDishesUseCase;
use Yummi\Application\UseCases\Orders\DeleteOrdersUseCase\DeleteOrdersUseCase;
use Yummi\Application\UseCases\Orders\DeleteSideDishesUseCase\DeleteSideDishesUseCase;
use Yummi\Application\UseCases\Orders\GetOrdersUseCase\GetOrdersUseCase;
use Yummi\Application\UseCases\Orders\GetSideDishesUseCase\GetSideDishesUseCase;
use Yummi\Application\UseCases\Pizzas\AddOrUpdatePizzaUseCase\AddOrUpdatePizzaUseCase;
use Yummi\Application\UseCases\Pizzas\DeletePizzaUseCase\DeletePizzaUseCase;
use Yummi\Application\UseCases\Pizzas\GetPizzasUseCase\GetPizzasUseCase;
use Yummi\Application\UseCases\Salads\AddOrUpdateSaladUseCase\AddOrUpdateSaladUseCase;
use Yummi\Application\UseCases\Salads\DeleteSaladUseCase\DeleteSaladUseCase;
use Yummi\Application\UseCases\Salads\GetSaladsUseCase\GetSaladsUseCase;
use Yummi\Application\UseCases\Users\AddOrUpdateUserUseCase\AddOrUpdateUserUseCase;
use Yummi\Application\UseCases\Users\DeleteUserUseCase\DeleteUserUseCase;
use Yummi\Application\UseCases\Users\GetUsersUseCase\GetUsersUseCase;
use Yummi\Infrastructure\DataAccess\ContentRepository;
use Yummi\Infrastructure\DataAccess\DrinksRepository;
use Yummi\Infrastructure\DataAccess\OrderRepository;
use Yummi\Infrastructure\DataAccess\PizzasRepository;
use Yummi\Infrastructure\DataAccess\SaladsRepository;
use Yummi\Infrastructure\DataAccess\UsersRepository;

class YummiServiceProvider extends ServiceProvider
{
    public function register()
    {
        //UseCases
        $this->app->bind(IGetUsersUseCase::class, GetUsersUseCase::class);
        $this->app->bind(IAddOrUpdateUserUseCase::class, AddOrUpdateUserUseCase::class);
        $this->app->bind(IAddOrUpdateSaladUseCase::class, AddOrUpdateSaladUseCase::class);
        $this->app->bind(IAddOrUpdateDrinkUseCase::class, AddOrUpdateDrinkUseCase::class);
        $this->app->bind(IAddOrUpdatePizzaUseCase::class, AddOrUpdatePizzaUseCase::class);
        $this->app->bind(IAddOrUpdateSideDishesUseCase::class, AddOrUpdateSideDishesUseCase::class);
        $this->app->bind(IAddOrUpdateOrdersUseCase::class, AddOrUpdateOrdersUseCase::class);
        $this->app->bind(IDeleteDrinkUseCase::class, DeleteDrinkUseCase::class);
        $this->app->bind(IDeleteOrdersUseCase::class, DeleteOrdersUseCase::class);
        $this->app->bind(IDeletePizzaUseCase::class, DeletePizzaUseCase::class);
        $this->app->bind(IDeleteSaladUseCase::class, DeleteSaladUseCase::class);
        $this->app->bind(IDeleteUserUseCase::class, DeleteUserUseCase::class);
        $this->app->bind(IDeleteSideDishesUseCase::class, DeleteSideDishesUseCase::class);
        $this->app->bind(IGetContentUseCase::class, GetContentUseCase::class);
        $this->app->bind(IGetDrinksUseCase::class, GetDrinksUseCase::class);
        $this->app->bind(IGetOrdersUseCase::class, GetOrdersUseCase::class);
        $this->app->bind(IGetPizzasUseCase::class, GetPizzasUseCase::class);
        $this->app->bind(IGetSaladsUseCase::class, GetSaladsUseCase::class);
        $this->app->bind(IGetSideDishesUseCase::class, GetSideDishesUseCase::class);
        $this->app->bind(IUpdateContentUseCase::class, UpdateContentUseCase::class);

        //Repositories
        $this->app->bind(IUsersRepository::class, UsersRepository::class);
        $this->app->bind(IContentRepository::class, ContentRepository::class);
        $this->app->bind(IDrinksRepository::class, DrinksRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IPizzasRepository::class, PizzasRepository::class);
        $this->app->bind(ISaladsRepository::class, SaladsRepository::class);
    }

    public function boot() {
        Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
    }
}