<?php 
namespace App\GraphQL\Mutation;

use App\Repository\ProductsRepository;
use App\Repository\CategoriesRepository;

use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class ProductsMutation implements MutationInterface
{
    /**
     * @var ProductsRepository
     */
    protected $productRepo;

    /**
     * @var CategoriesRepository
     */
    protected $categoryRepo;


    public function __construct(ProductsRepository $productRepo,CategoriesRepository $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        
    }


    public function insertProduct($productInput){

        try{
            $categoryFound=$this->categoryRepo->findByName($productInput['category']);
            if($categoryFound){
                $productInput['categoryId']=$categoryFound->getId();
            }else{
                $categoryIdInserted=$this->categoryRepo->insert( 
                                            array(
                                                'name'=>$productInput['category']
                                                ) );
                $productInput['categoryId']=$categoryIdInserted;
            }

            $productIdInserted=$this->productRepo->insert( $productInput);

            return (object)array(
                'id'=>$productIdInserted,
                'status' =>'ok',
                'message'=>'Successfully inserted'
            );
        }catch(\Exception $e){
            return (object)array(
                'id'=>null,
                'status'=>'KO',
                'message'=>$e->getMessage()
            );
        }

    }

}