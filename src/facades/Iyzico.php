<?php namespace Hkucuk\Iyzico\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: hkucuk
 * Date: 17.08.2015
 * Time: 18:33
 */

Class Iyzico extends Facade{

    protected static function getFacadeAccessor(){ return "iyzico"; }

}