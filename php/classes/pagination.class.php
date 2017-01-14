<?php
/**
 * Created by PhpStorm.
 * User: James Singizi
 * Date: 06/12/2016
 * Time: 19:15
 */

class Pagination {

    public $current_page;
    public $per_page;
    public $total_count;

    /**
     *
     * @param $page
     * @param $per_page
     * @param $total_count
     */
    public function __construct($page = 1, $per_page = 10, $total_count = 0){
        $this->current_page = (int)$page;
        $this->per_page = (int)$per_page;
        $this->total_count = (int)$total_count;

    }

    /**
     *
     * @return number
     */
    public function total_pages(){
        return ceil($this->total_count/$this->per_page);
    }

    /**
     *
     * @return number
     */
    public function next_page(){
        return $this->current_page+1;
    }

    /**
     *
     * @return number
     */
    public function previous_page(){
        return $this->current_page-1;
    }

    /**
     *
     * @return boolean
     */
    public function has_next_page(){
        return ($this->next_page()<=$this->total_pages())?true:false;
    }

    /**
     *
     * @return boolean
     */
    public function has_previous_page(){
        return ($this->previous_page()>=1)?true:false;
    }
    /**
     *
     * @return number
     */
    public function offset(){
        return ($this->current_page-1)*$this->per_page;
    }


}