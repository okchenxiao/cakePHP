<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model
{
    /*解绑和模型关联的使用模型*/
    public function unbindAll()
    {
        $associated = $this->getAssociated();
        $associate = array();
        foreach ($associated as $model => $assoc) {
            if ($assoc == 'belongsTo') {
                $associate['belongsTo'][] = $model;
            }
            if ($assoc == 'hasMany') {
                $associate['hasMany'][] = $model;
            }
            if ($assoc == 'hasOne') {
                $associate['hasOne'][] = $model;
            }
            if ($assoc == 'hasAndBelongsToMany') {
                $associate['hasAndBelongsToMany'][] = $model;
            }
        }

        $this->unbindModel($associate);
    }

    /*解绑传入模型以外的关联模型*/
    public function unbindModel_except($mod = array())
    {
        $associated = $this->getAssociated();
        $associate = array();
        foreach ($associated as $model => $assoc) {
            if (in_array($model, $mod)) {
                continue;
            }

            if ($assoc == 'belongsTo') {
                $associate['belongsTo'][] = $model;
            }
            if ($assoc == 'hasMany') {
                $associate['hasMany'][] = $model;
            }
            if ($assoc == 'hasOne') {
                $associate['hasOne'][] = $model;
            }
            if ($assoc == 'hasAndBelongsToMany') {
                $associate['hasAndBelongsToMany'][] = $model;
            }
        }

        $this->unbindModel($associate);
    }
}
