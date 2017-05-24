<?php

namespace wolfteam\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $expired_at;

    public function __construct()
    {
        $this->expired_at = Carbon::now(7);
    }

    public function view_paginate($collection)
    {
        $abs = 3;
        $paginate = '';

        if($collection->lastPage() != 1)
        {
            $paginate .= '<nav aria-label="Page navigation text-center">';
            $paginate .= '<ul class="pagination pagination-lg">';
            $paginate .= '<li>';
            $paginate .= '<a href="'.$collection->previousPageUrl().'" aria-label="Previous">';
            $paginate .= '<span aria-hidden="true">&laquo;</span>';
            $paginate .= '</a>';
            $paginate .= '</li>';

            if($collection->lastPage() < 7 + ($abs * 2)){
                for($i = 1; $i < $collection->lastPage() + 1; $i++) {
                    if ($collection->currentPage() == $i) {
                        $paginate .= '<li class="active"><a href="' . $collection->url($i) . '">' . $i . '</a></li>';
                    }else{
                        $paginate .= '<li><a href="' . $collection->url($i) . '">' . $i . '</a></li>';
                    }
                }
            } else{
                if($collection->currentPage() < 2 + ($abs * 2)) {
                    if ($collection->currentPage() == 1) {
                        $paginate .= '<li class="active"><a href="' . $collection->url(1) . '">1</a></li>';
                    } else {
                        $paginate .= '<li><a href="' . $collection->url(1) . '">1</a></li>';
                    }
                    for ($i = 2; $i < 4 + (3 * 2); $i++){
                        if ($collection->currentPage() == $i) {
                            $paginate .= '<li class="active"><a href="' . $collection->url($i) . '">' . $i . '</a></li>';
                        }else{
                            $paginate .= '<li><a href="' . $collection->url($i) . '">' . $i . '</a></li>';
                        }
                    }
                    $paginate .= '<li class="disabled"><a href="#">...</a></li>';
                    if ($collection->currentPage() == $collection->lastPage() - 2) {
                        $paginate .= '<li class="active"><a href="'.$collection->url($collection->lastPage() - 2).'">'.($collection->lastPage() - 2).'</a></li>';
                    } else {
                        $paginate .= '<li><a href="'.$collection->url($collection->lastPage() - 2).'">'.($collection->lastPage() - 2).'</a></li>';
                    }
                    if ($collection->currentPage() == $collection->lastPage() - 1) {
                        $paginate .= '<li class="active"><a href="'.$collection->url($collection->lastPage() - 1).'">'.($collection->lastPage() - 1).'</a></li>';
                    } else {
                        $paginate .= '<li><a href="'.$collection->url($collection->lastPage() - 1).'">'.($collection->lastPage() - 1).'</a></li>';
                    }
                    if ($collection->currentPage() == $collection->lastPage()) {
                        $paginate .= '<li class="active"><a href="'.$collection->url($collection->lastPage()).'">'.($collection->lastPage()).'</a></li>';
                    } else {
                        $paginate .= '<li><a href="'.$collection->url($collection->lastPage()).'">'.($collection->lastPage()).'</a></li>';
                    }
                }elseif ( (($abs *2) + 1 < $collection->currentPage()) && ($collection->currentPage() < $collection->lastPage() - ($abs * 2)) ){
                    if ($collection->currentPage() == 1) {
                        $paginate .= '<li class="active"><a href="' . $collection->url(1) . '">1</a></li>';
                    } else {
                        $paginate .= '<li><a href="' . $collection->url(1) . '">1</a></li>';
                    }
                    if ($collection->currentPage() == 2) {
                        $paginate .= '<li class="active"><a href="' . $collection->url(2) . '">2</a></li>';
                    } else {
                        $paginate .= '<li><a href="' . $collection->url(2) . '">2</a></li>';
                    }
                    $paginate .= '<li class="disabled"><a href="#">...</a></li>';
                    for($i = ($collection->currentPage() -3); $i <= ($collection->currentPage() + $abs); $i++ ){
                        if ($collection->currentPage() == $i) {
                            $paginate .= '<li class="active"><a href="' . $collection->url($i) . '">' . $i . '</a></li>';
                        }else{
                            $paginate .= '<li><a href="' . $collection->url($i) . '">' . $i . '</a></li>';
                        }
                    }
                    $paginate .= '<li class="disabled"><a href="#">...</a></li>';
                    if ($collection->currentPage() == $collection->lastPage() - 1) {
                        $paginate .= '<li class="active"><a href="'.$collection->url($collection->lastPage() - 1).'">'.($collection->lastPage() - 1).'</a></li>';
                    } else {
                        $paginate .= '<li><a href="'.$collection->url($collection->lastPage() - 1).'">'.($collection->lastPage() - 1).'</a></li>';
                    }
                    if ($collection->currentPage() == $collection->lastPage()) {
                        $paginate .= '<li class="active"><a href="'.$collection->url($collection->lastPage()).'">'.($collection->lastPage()).'</a></li>';
                    } else {
                        $paginate .= '<li><a href="'.$collection->url($collection->lastPage()).'">'.($collection->lastPage()).'</a></li>';
                    }
                }else{
                    if ($collection->currentPage() == 1) {
                        $paginate .= '<li class="active"><a href="' . $collection->url(1) . '">1</a></li>';
                    } else {
                        $paginate .= '<li><a href="' . $collection->url(1) . '">1</a></li>';
                    }
                    if ($collection->currentPage() == 2) {
                        $paginate .= '<li class="active"><a href="' . $collection->url(2) . '">2</a></li>';
                    } else {
                        $paginate .= '<li><a href="' . $collection->url(2) . '">2</a></li>';
                    }
                    $paginate .= '<li class="disabled"><a href="#">...</a></li>';
                    for( $i = $collection->lastPage() - (2 + ($abs * 2)); $i < $collection->lastPage() + 1; $i++ ){
                        if ($collection->currentPage() == $i) {
                            $paginate .= '<li class="active"><a href="' . $collection->url($i) . '">' . $i . '</a></li>';
                        }else{
                            $paginate .= '<li><a href="' . $collection->url($i) . '">' . $i . '</a></li>';
                        }
                    }
                }
            }

            $paginate .= '<li>';
            $paginate .= '<a href="'.$collection->nextPageUrl().'" aria-label="Next">';
            $paginate .= '<span aria-hidden="true">&raquo;</span>';
            $paginate .= '</a>';
            $paginate .= '</li>';
            $paginate .= '</ul>';
            $paginate .= '</nav>';
        }

        return $paginate;
    }
}
