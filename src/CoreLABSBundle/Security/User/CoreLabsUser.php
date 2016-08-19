<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreLABSBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\Role\Role;

/**
 * Description of CoreUser
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class CoreLabsUser implements UserInterface, EquatableInterface{

    private $firstname;
    private $lastname;
    private $id;
    private $phone;
    private $email;
    private $pi_id;
    private $pi_name;
    private $password;
    
    private $username;
    
    private $roles;
    private $isactive;
    private $note;
    
    private $salt;
    
    public function __construct($username,$password,$salt, array $roles) {
        
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
        
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        return $this->type;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->username;
    }

    public function isEqualTo(UserInterface $user) {
        
        if( ! $user instanceof CoreLabsUser){
            return false;
        }
        
        if( $this->password !== $user->getPassword()){
            return false;
        }
        
        if( $this->salt !== $user->getSalt()){
            return false;
        }
        
        if( $this->username !== $user->getUsername()){
            return false;
        }  
    }

}
