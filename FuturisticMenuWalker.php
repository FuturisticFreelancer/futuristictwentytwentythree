<?php

class Futuristic_Menu_Walker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if($depth == 0){
            $output .= '<li class="nav-item dropdown has-medium-font-size">';
        }else{
            $output .= '<li class="menu-color has-medium-font-size">';
        }
        if($this->has_children){
            $output .= '<a class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">'.$item->title.'</a>';
            $output .= '<ul class="dropdown-menu pt-0 pb-0">';
        }else{
            if($depth == 0)
                $output .= '<a class="nav-link" href="'.$item->url.'">'.$item->title.'</a>';
            else{
                $output .= '<a class="dropdown-item" href="'.$item->url.'">'.$item->title.'</a>';
            }
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }
}