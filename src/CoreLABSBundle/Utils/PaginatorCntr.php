<?php

/*
 * Copyright (C) 2016 Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace CoreLABSBundle\Utils;

use CoreLABSBundle\Entity\CoreUserSearchOptions;
use CoreLABSBundle\Entity\CoreUserVO;

/**
 * Description of PaginatorCntr
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class PaginatorCntr {
    
   public static function generateLinks(CoreUserSearchOptions $options, array $users){
       $links = array('first'=>'FIRST','last'=>'LAST','prev'=>null,'next'=>null);
       
       return $links;
   }
}
