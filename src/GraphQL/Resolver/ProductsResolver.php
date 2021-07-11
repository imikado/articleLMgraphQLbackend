<?php
namespace App\GraphQL\Resolver;

use App\Repository\ProductsRepository;

use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

Class ProductsResolver implements ResolverInterface
{
    /**
     * @var ProductsRepository
     */
    protected $repo;


    public function __construct(ProductsRepository $repo)
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