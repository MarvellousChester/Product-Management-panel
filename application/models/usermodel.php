<?php
namespace Cgi\Application\Models;

use Cgi\Application\Core\ModelAbstract;

class UserModel extends ModelAbstract
{
    protected function getTableName()
    {
        return 'user';
    }

    protected function beforeSave()
    {
        if (!$this->isLoaded) {
            $this->data['creation_date'] = date('Y-m-d H:i:s');
        }
    }


    /**Find a user by his attribute
     * @param $field
     * @param $value
     *
     * @return UserModel|null
     */
    public static function findBy($field, $value)
    {
        $sqlQuery = "SELECT * FROM `user` WHERE `$field` = ?";
        $statement = self::$dbh->prepare($sqlQuery);
        $statement->execute([$value]);
        $values = $statement->fetch();
        unset($values['user_id']);
        if($values == null) {
            return null;
        }
        else return new self($values);
    }

    /**Validates a user.
     * @param $email
     * @param $password
     *
     * @return bool
     */
    public static function validate($email, $password)
    {
        $user = self::findBy('email', $email);
        if ($user == null) {
            return false;
        } elseif ($user->get('password') == $password) {
            return true;
        } else {
            return false;
        }
    }

    public static function isGuest()
    {
        return (!isset($_SESSION["isAuth"]) || !($_SESSION["isAuth"] == true));
    }
}