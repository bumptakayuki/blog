<?php

namespace Service;

/**
 * Class PostValidation
 */
class PostValidation
{
    /**
     * @param $title
     * @param $description
     * @param $categoryId
     * @return array
     */
    public function addValidation($title, $description, $image){

        $errors = [];

        if (empty($title)){
            $errors['title'] = 'タイトルがありません。<br>';
        }
        if (mb_strlen($title) > 80){
            $errors['title'] = 'タイトルが長すぎます。<br>';
        }
        if (empty($description)){
            $errors['description'] = '説明文がありません。<br>';
        }
        if (empty($image)){
            $errors['description'] = '画像がありません。<br>';
        }

        return $errors;
    }
}