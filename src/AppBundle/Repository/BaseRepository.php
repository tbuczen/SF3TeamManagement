<?php
/**
 * Created by PhpStorm.
 * User: urias
 * Date: 30.01.17
 * Time: 10:42
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository
{

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id){
        $obj = $this->find($id);
        try{
            $this->_em->remove($obj);
            $this->_em->flush();
        }catch (\Exception $e){
            return false;
        }
        return true;
    }
}