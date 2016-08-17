<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreLABSBundle\Entities;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\Role;

/**
 * Description of CoreUser
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class CoreUser implements UserInterface {

    private $firstname;
    private $lastname;
    private $id;
    private $phone;
    private $email;
    private $pi_id;
    private $pi_name;
    private $password;
    
    private $username;
    
    private $type;
    private $isactive;
    private $note;
    
    public function getUsername() {
        return $this->username;
    }

    public function getRoles() {
        return $this->type;
    }

    public function getPassword() {
        
    }

    public function getSalt() {
        
    }

    public function eraseCredentials() {
        
    }
    
    public function setUserName($username){
        $this->username = $username;
    }
    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getId() {
        return $this->id;
    }

    function getPhone() {
        return $this->phone;
    }

    function getEmail() {
        return $this->email;
    }

    function getPi_id() {
        return $this->pi_id;
    }

    function getPi_name() {
        return $this->pi_name;
    }

    function getType() {
        return $this->type;
    }

    function getIsactive() {
        return $this->isactive;
    }

    function getNote() {
        return $this->note;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPi_id($pi_id) {
        $this->pi_id = $pi_id;
    }

    function setPi_name($pi_name) {
        $this->pi_name = $pi_name;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setIsactive($isactive) {
        $this->isactive = $isactive;
    }

    function setNote($note) {
        $this->note = $note;
    }


}
