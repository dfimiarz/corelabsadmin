<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreLABSBundle\Entity;

use CoreLABSBundle\Entity\CoreUserVO;
use Doctrine\DBAL\Connection as DBLAConn;
use CoreLABSBundle\Entity\CoreUserSearchOptions as SearchOptions;

/**
 * Description of CoreUserDAO
 * 
 * DAO object for fetching user (core_user) related information
 *
 * @author Daniel F
 */
class CoreUserDAO {

    private $conn;
    private $field_map;

    function __construct(DBLAConn $conn) {
        $this->conn = $conn;
        $this->field_map = array("un" => "username", "fn" => "firstname", "ln" => "lastname");
    }

    /*
     * TODO: Use specific options class instead of generic stdClass
     */

    public function getUsers(SearchOptions $options) {
        $users = array();

        $qb = $this->conn->createQueryBuilder();

        $qb->select('id', 'firstname', 'lastname', 'phone', 'email', 'username')
                ->from('core_users')
                ->setMaxResults($options->limit);


        $order = "ASC";

        $andCond = $qb->expr()->andX();
        
        if( isset($options->fType) && isset($options->fValue)){    
            $andCond->add($qb->expr()->like($this->field_map[$options->fType],$qb->expr()->literal("%" . $options->fValue . "%")));
        }
        
//        if (is_numeric($options->nextItem)) {
//
//            $filter = "id >= :id";
//            $order = 'ASC';
//
//            if ($options->direction == -1) {
//                $filter = "id <= :id";
//                $order = 'DESC';
//            }
//
//            $qb->andWhere($filter)
//                    ->setParameter("id", $options->nextItem);
//        }
        
        $qb->andWhere($andCond);
        
        $qb->orderBy('id', $order);

        $stmt = $qb->execute();

        while ($user_data = $stmt->fetch()) {
            /* @var $user CoreUserVO */
            $user = new CoreUserVO($user_data["id"]);
            $user->setUsername($user_data["username"]);
            $user->setFirstname($user_data["firstname"]);
            $user->setLastname($user_data["lastname"]);
            $user->setEmail($user_data["email"]);
            $user->setPhone($user_data["phone"]);

            $users[] = $user;
        }

        $stmt->closeCursor();

        if( $options->direction == -1 ){
            $users = \array_reverse($users);
        }

        return $users;
    }

    /**
     * 
     * @param type $key
     * @param type $type
     * @param type $active
     * @param type $item_cnt
     * @param type $item_id
     * @return CoreUserVO
     * @throws \Exception
     */
    public function findUsers($key, $type = "un", $active = 1, $item_id = "FIRST", $item_cnt = 10) {

        $users = array();

        $stmt = $this->prepareQuery($key, $type, $active, $item_cnt, $item_id);

        if (!$stmt->execute()) {
            throw new \Exception($stmt->error, $stmt->errno);
        }

        $user_data = new \stdClass();

        if (!$stmt->bind_result($user_data->id, $user_data->firstname, $user_data->lastname, $user_data->phone, $user_data->email, $user_data->username)) {
            throw new \Exception($stmt->error, $stmt->errno);
        }

        while ($stmt->fetch()) {
            /* @var $user CoreUserVO */
            $user = new CoreUserVO($user_data->id);
            $user->setUsername($user_data->username);
            $user->setFirstname($user_data->firstname);
            $user->setLastname($user_data->lastname);
            $user->setEmail($user_data->email);
            $user->setPhone($user_data->phone);

            $users[] = $user;
        }

        $stmt->close();

        return $users;
    }

    /**
     * 
     * @param type $type
     * @param type $active
     * @param type $item_cnt
     * @param type $last_id
     * @return type
     * @throws \Exception
     */
    private function prepareQuery($key, $type, $active, $item_cnt, $item_id) {

        $query = "";

        $s_field = array_key_exists($type, $this->field_map) ? $this->field_map[$type] : $this->field_map["un"];

        //sort diration for the query
        $dir = !\strcmp("LAST", $item_id) ? "ASC" : "DESC";

        //where parameters for the query
        $where_params = array();
        $types = array();
        $val_params = array();

        if (!empty($key)) {
            $where_params[] = $s_field . " = ?";
            $types[] = \PDO::PARAM_STR;
            $val_params[] = $key;
        }

        if (!empty($active)) {
            $where_params[] = "active = ?";
            $types[] = \PDO::PARAM_INT;
            $val_params[] = $active;
        }

        $where = " WHERE " . \implode(" AND ", $where_params);



        $q_templ = "SELECT id, firstname, lastname, phone, email, username FROM core_users " . $where . " ORDER BY id " . $dir . " LIMIT ?";

        echo $q_templ;
        echo $types;
        exit();

        if (!($stmt = $this->mysqli->prepare($q_templ))) {
            throw new \Exception($$this->mysqli->error, $$this->mysqli->errno);
        }



//        $key_param = "%" . $key . "%";       
//        
        if (!$stmt->bind_param("i", $item_cnt)) {
            throw new \Exception($stmt->error, $stmt->errno);
        }

        return $stmt;
    }

}
