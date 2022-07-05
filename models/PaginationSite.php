<?php

namespace app\models;
use yii\data\Pagination;

class PaginationSite
{
    public static function getPagination($query, $count, $pageSize, $sort = 'desc')
    {
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        $articles = $query->offset($pagination->offset)
            ->orderBy('date ' . $sort)
            ->limit($pagination->limit)
            ->all();

        $data['element'] = $articles;
        $data['pagination'] = $pagination;

        return $data;
    }
}