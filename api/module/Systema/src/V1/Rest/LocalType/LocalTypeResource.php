<?php
namespace Systema\V1\Rest\LocalType;

use Doctrine\ORM\Tools\Pagination\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Laminas\EventManager\EventManager;
use Systema\Entities\LocalType;
use Systema\Service\SystemaService;

class LocalTypeResource extends AbstractResourceListener
{

    private SystemaService $systemaSrv;

    public function __construct(SystemaService $systemaSrv)
    {
        $this->systemaSrv = $systemaSrv;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        /** @var \Systema\Entities\Repository\LocalType $localTypeRepo */
        $localTypeRepo = $this->systemaSrv->getORM()->getRepository(LocalType::class);
        $query = $localTypeRepo->getFetchQuery(['localTypeId'=>$id]);

        try {
            $localType = $query->getSingleResult();
        }catch(\Doctrine\ORM\NonUniqueResultException $ex){
            return new ApiProblem(500, 'C\'é stato un problema nel reperire il dato [1]');
        }catch (\Doctrine\ORM\NoResultException $ex) {
            return new ApiProblem(404, 'Non é stato trovato il Local Type');
        }

        return new LocalTypeEntity($localType);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        /** @var \Systema\Entities\Repository\LocalType $localTypeRepo */
        $localTypeRepo = $this->systemaSrv->getORM()->getRepository(LocalType::class);
        $query = $localTypeRepo->getFetchQuery();

        return  new LocalTypeCollection($query);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
