<?php
/**
 * This file is part of the he8us/feedback package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace He8us\FeedbackBundle\Entity;

use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityRepository;

class FeedbackRepository extends EntityRepository
{

    /**
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int        $limit
     * @param int        $offset
     *
     * @return array
     */
    public function findBy(array $criteria = [], array $orderBy = null, $limit = 0, $offset = 0)
    {
        return parent::findBy($this->fixCriteria($criteria), $orderBy, $limit, $offset);
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    private function fixCriteria(array $criteria)
    {
        if (!in_array('deleted', $criteria)) {
            $criteria['deleted'] = false;
        }

        return $criteria;
    }

    /**
     * @param mixed    $id
     * @param int|null $lockMode
     * @param null     $lockVersion
     *
     * @return null|Feedback
     */
    public function find($id, $lockMode = LockMode::NONE, $lockVersion = null)
    {
        return $this->findOneBy([
            'id' => $id,
        ]);
    }

    /**
     * @param array      $criteria
     * @param array|null $orderBy
     *
     * @return null|Feedback
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return parent::findOneBy($this->fixCriteria($criteria), $orderBy);
    }
}
