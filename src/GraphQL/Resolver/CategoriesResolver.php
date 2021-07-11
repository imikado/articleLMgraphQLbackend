<?php
namespace App\GraphQL\Resolver;

use App\Repository\CategoriesRepository;

use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

Class CategoriesResolver implements ResolverInterface
{
    /**
     * @var CategoriesRepository
     */
    protected $repo;


    public function __construct(CategoriesRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(){

        $rowList= $this->repo->findAll();

        return $rowList;
    }

    public function getById($id){
        return $this->repo->find($id);
    }


}