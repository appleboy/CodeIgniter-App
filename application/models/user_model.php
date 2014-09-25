<?php

/**
 * User Model
 *
 * @copyright Copyright (c) 2014, Bo-Yi Wu <http://blog.wu-boy.com>
 */

class User_model extends MY_Model
{
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
}
