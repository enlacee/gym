<?php

class Categoria_model extends CI_Model {

    protected $_name = 'ac_categorias';

    const CAT_GYM = 1;
    const CAT_VITAMINAS = 2;
    const CAT_OTRO = 3;

    public function __construct() {
        parent::__construct();
    }

}
