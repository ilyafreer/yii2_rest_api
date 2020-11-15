<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m201110_210933_news_category
 */
class m201110_210933_news_category extends Migration
{
    const TABLE_NAME = 'news_category';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $categories = [
            [
                'id'=>1,
                'title'=>'Общество',
                'parent_id'=>0
            ],
            [
                'id'=>2,
                'title'=>'Городская жизнь',
                'parent_id'=>1
            ],
            [
                'id'=>3,
                'title'=>'Выборы',
                'parent_id'=>1
            ],
            [
                'id'=>4,
                'title'=>'День города',
                'parent_id'=>0
            ],
            [
                'id'=>5,
                'title'=>'Салюты',
                'parent_id'=>4
            ],
            [
                'id'=>6,
                'title'=>'Детская площадка',
                'parent_id'=>0
            ],
            [
                'id'=>7,
                'title'=>'0-3 года',
                'parent_id'=>6
            ],
            [
                'id'=>8,
                'title'=>'3-7 года',
                'parent_id'=>6
            ],
            [
                'id'=>9,
                'title'=>'Спорт',
                'parent_id'=>0
            ],
        ];
        $this->createTable(self::TABLE_NAME, [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
        foreach ($categories as $category){
            $this->insert(self::TABLE_NAME, [
                'id'=> $category['id'],
                'title' => $category['title'],
                'parent_id' => $category['parent_id'],
            ]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
