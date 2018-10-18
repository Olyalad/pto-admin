<?php

use app\models\User;
use yii\db\Migration;
use yii\db\Query;

/**
 * Class m181007_131348_migrate_user_table
 */
class m181007_131348_migrate_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $admin->description = 'Админ';
        $auth->add($admin);

        $gr_exp = $auth->createRole('group_expert');
        $gr_exp->description = 'Эксперт Группы';
        $auth->add($gr_exp);

        $expert = $auth->createRole('user_expert');
        $expert->description = 'Пользователь Эксперт';
        $auth->add($expert);


        $oldUsers = (new Query())
            ->from('users')
            ->all();

        foreach ($oldUsers as $oldUser) {

            $userModel = User::findOne($oldUser['id']);
            if (!$userModel)
                $userModel = new User(['id' => $oldUser['id']]);

            $userModel->login = $oldUser['login'];
            $userModel->setPassword($oldUser['pass']);
            $userModel->first_name = $oldUser['name'];
            $userModel->size = $oldUser['size'];
            $userModel->generateAuthKey();
            $userModel->status = User::STATUS_ACTIVE;
            $userModel->s = $oldUser['s'];
            $userModel->groups = $oldUser['groups'];

            if ($userModel->save()) {
                echo "    > add record `{$userModel->login}` in `lb_user` table\n\r";

                // у кого роль admin - admin
                if ($oldUser['sec'] == 'admin') {
                    $auth->assign($admin, $userModel->id);
                    echo "    > user `{$userModel->login}` is `admin`\n\r";
                }

                // у кого роль expert - manager
                if ($oldUser['sec'] == 'expert') {
                    $auth->assign($gr_exp, $userModel->id);
                    echo "    > user `{$userModel->login}` is `group_expert`\n\r";
                }

                // пользователь expert какой то особенный
                if ($oldUser['login'] == 'expert') {
                    $auth->assign($expert, $userModel->id);
                    echo "    > user `{$userModel->login}` is `user_expert`\n\r";
                }

            }
        }

        $this->insert('canal', [
            'namek' => 'Пальчун',
            'sk' => '',
            'seck' => '',
        ]);
        $this->insert('canal', [
            'namek' => 'Сундукова',
            'sk' => '',
            'seck' => '',
        ]);
        $this->insert('canal', [
            'namek' => 'Тощевикова',
            'sk' => '',
            'seck' => '',
        ]);
//        $this->insert('canal', [
//            'namek' => 'Промо',
//            'sk' => 200,
//            'seck' => '',
//        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->delete('canal', ['namek' => 'Промо']);
        $this->delete('canal', ['namek' => 'Тощевикова']);
        $this->delete('canal', ['namek' => 'Сундукова']);
        $this->delete('canal', ['namek' => 'Пальчун']);

        $this->delete('lb_user');

        $auth = Yii::$app->authManager;
        $auth->removeAllRoles();
    }
}
