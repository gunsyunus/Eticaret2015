<?php

namespace App\Helpers;

use URL;

class NodeList
{
    /**
     * Baum Package - Node List => Select
     *
     * @param  string $node
     * @return string
     */
    public static function getSelect($node)
    {
        $html = '<option value="'.$node->id_category.'">'.str_repeat('---', $node->depth).' '.$node->name .'</option>';
        
        foreach ($node->children as $child) {
            $html .= static::getSelect($child);
        }
        if ($node->depth==0) {
            $html .= '<option disabled="disabled" class="select-line"></option>';
        }

        return $html;
    }

    /**
     * Baum Package - Node List => Div,Li Html Element Frontend List
     *
     * @param  string $node
     * @return string
     */
    public static function getAccordionMenu($node)
    {
        if ($node->isLeaf()) {
            return '<li class="level1">
                        <span class="main-cat">
                            <a href="'.Sef::category($node->sef_url,$node->id_category).'">'.$node->name.'</a>
                        </span>
                    </li>';
        } else {
            $html = '<li class="level1 open"><span class="main-cat"><a href="#">'.$node->name.'</a></span>';
            $html .= '<ul>';
            foreach ($node->children as $child) {
                $html .= static::getAccordionMenu($child);
            }
            $html .= '</ul>';
            $html .= '</li>';
        }
        
        return $html;
    }
}
