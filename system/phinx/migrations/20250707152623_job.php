<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Job extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        if ($this->hasTable('job')) {
            return;
        }

        $this->table('job', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'integer', ['identity' => true])
            ->addColumn('user_id', 'integer')
            ->addColumn('title', 'string', ['limit' => 100])
            ->addColumn('description', 'string', ['limit' => 1000])
            ->addColumn('status', 'char', ['limit' => 1, 'default' => '1'])
            ->addColumn('date', 'datetime')
            ->addForeignKey('user_id', 'user', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
