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

namespace CoreLABSBundle\Entity;

use Symfony\Component\HttpFoundation\Request as Request;
/**
 * Description of CoreUserSearchOptions
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class CoreUserSearchOptions {
   
    public $fType;
    public $fValue;
    
    public $nextItem;
    public $limit;
    public $direction;
    
    public function __construct(Request $request) {
        /*
         * Get filter options
         */
        $this->fType = $request->query->get("ftype", "un" );
        $this->fValue = $request->query->get("fval", null);       
        
        /*
         * Get paging params from the query params
         */
        $this->nextItem = $request->query->get("next", "FIRST");
        $this->limit = $request->query->get("psize", 10);
        $this->direction = $request->query->get("dir",1);
    }
    
}
