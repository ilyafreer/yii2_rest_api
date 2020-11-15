<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m201110_211827_news
 */
class m201110_211827_news extends Migration
{
    const TABLE_NAME = 'news';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $news = [
            [
                'news_category_id'=>1,
                'title'=>'Новости общества',
                'content'=>'Какой то текст о новостях общества'
            ],
            [
                'news_category_id'=>2,
                'title'=>'Новости про городску жизнь',
                'content'=>'Снова демо текст'
            ],
            [
                'news_category_id'=>3,
                'title'=>'Выборы существуют',
                'content'=>'Фанатстика или реальность, свежи новости о выборах'
            ],
            [
                'news_category_id'=>4,
                'title'=>'Празднвоание дня города',
                'content'=>'Какой то текс про день города'
            ],

        ];
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'news_category_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'content' => $this->text(),
        ]);
        $this->createIndex(
            'idx-title',
            self::TABLE_NAME,
            'title'
        );
        $this->addForeignKey(
            'fk-category_id',
            self::TABLE_NAME,
            'news_category_id',
            'news_category',
            'id',
            'CASCADE'
        );

        foreach ($news as $itemNews) {
            $this->insert(self::TABLE_NAME, [
                'news_category_id' => $itemNews['news_category_id'],
                'title' =>  $itemNews['title'],
                'content' =>  $itemNews['content'],
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
