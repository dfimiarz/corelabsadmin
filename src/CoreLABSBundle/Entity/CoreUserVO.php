<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreLABSBundle\Entity;

/**
 * Description of CoreUserVO
 *
 * @author Daniel F
 */
class CoreUserVO {

    private $id;
    private $firstname;
    private $lastname;
    private $phone;
    private $email;
    private $piID;
    private $username;
    private $password;
    private $userType;
    private $activeFlag;
    
    
    /* @var $last_active String in RFC3339 format*/
    private $lastActive;
    
    private $note;

    public function __construct($id) {
        $this->id = $id;
    }
    
    function setUsername($username) {
        $this->username = $username;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPiID($piID) {
        $this->piID = $piID;
    }

    function setUserType($user_type) {
        $this->userType = $user_type;
    }

    function setActiveFlag($active_flag) {
        $this->activeFlag = $active_flag;
    }

    function setLastActive(\DateTime $lastActive) {
        $this->lastActive = $lastActive->format(\DateTime::RFC3339);
    }

    function setNote($note) {
        $this->note = $note;
    }
    
    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }
        
    function getId() {
        return $this->id;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getPhone() {
        return $this->phone;
    }

    function getEmail() {
        return $this->email;
    }

    function getPiID() {
        return $this->piID;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getUserType() {
        return $this->userType;
    }

    function getActiveFlag() {
        return $this->activeFlag;
    }

    function getLastActive() {
        return $this->lastActive;
    }

    function getNote() {
        return $this->note;
    }
    
    function getFullName(){
        return $this->firstname . ' ' . $this->lastname;
    }
    
}
