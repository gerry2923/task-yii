<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsersSpecialization]].
 *
 * @see UsersSpecialization
 */
class UsersSpecializationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsersSpecialization[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsersSpecialization|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
