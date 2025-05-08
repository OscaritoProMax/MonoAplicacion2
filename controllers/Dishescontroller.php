<?php

namespace App\controllers;

use App\models\entities\Dishes;

class DishesController
{

    public function getAllDishes()
    {
        $model = new Dishes();
        $persons = $model->all();
        return $persons;
    }

    public function saveNewDishe($resquest)
    {
        $model = new Dishes();
        $model->set('description', $resquest['description']);
        $model->set('price', $resquest['price']);
        $model->set('idCategory', $resquest['idCategory']);
        $res = $model->registrar();
        return $res ? 'yes' : 'not';
    }

    public function updateDishe($resquest){
        $model = new Dishes();
        $model->set('description', $resquest['description']);
        $model->set('price', $resquest['price']);
        $model->set('idCategory', $resquest['idCategory']);
        if(empty($model->find())){
            return "empty";
        }
        $res =  $model->update();
        return $res ? 'yes' : 'not';
    }

    public function removeDishe($id){
        $model = new Dishes();
        $model->set('id', $id);
        if(empty($model->find())){
            return "empty";
        }
        $res =  $model->delete();
        return $res ? 'yes' : 'not';
    }

    public function getDishe($id){
        $model = new Dishes();
        $model->set('id', $id);
        return $model->find();
    }
}
