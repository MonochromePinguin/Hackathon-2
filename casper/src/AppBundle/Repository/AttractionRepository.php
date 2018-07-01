<?php

namespace AppBundle\Repository;

use AppBundle\Entity\FilterQuery;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\Expr\Join;

/**
 * AttractionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AttractionRepository extends \Doctrine\ORM\EntityRepository
{
    public function findFromFilterQuery(
        FilterQuery $filterQuery,
        array $multipleCriterias,
        array $singleCriterias
    ) : array {

        $query = $this->createQueryBuilder('att')->select('att.id');

        #each field whose name is in $multipleCriterias[] is an array of entities
        #
        foreach ($multipleCriterias as $key => $info) {
            # ↓ indirect field access
            $array = $filterQuery->$key;

            if (isset($array) && (0 != count($array))) {

                $field = $info['field'];
                $alias = $info['alias'];

                $expr = $query->expr();

                $query->join('att.' . $field, $alias);

                foreach ($array as $entity) {
                    $query->orWhere(
                        $expr->eq($alias . '.name', $expr->literal($entity->getName()) )
                    );
                }
            }
        }

/*            foreach (self::SINGLE_CRITERIAS as $key) {
            if (isset($query->$key)) {
                $criterias->andWhere($expr->eq($key, $query->$key));
            }
        }*/

        #TODO: the correct method is to use a custom hydratator:
        # see  https://stackoverflow.com/questions/11657835/how-to-get-a-one-dimensional-scalar-array-as-a-doctrine-dql-query-result
        return array_column($query->getQuery()->getScalarResult(), 'id');
    }
}
