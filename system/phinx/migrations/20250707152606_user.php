<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class User extends AbstractMigration
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
        if ($this->hasTable("user")) {
            return;
        }

        $this->table("user", ["id" => false, "primary_key" => "id"])
            ->addColumn("id", "integer", ["identity" => true])
            ->addColumn("name", "string", ["limit" => 100])
            ->addColumn("email", "string", ["limit" => 100])
            ->addColumn("password", "string", ["limit" => 60])
            ->addColumn("token", "string", ["limit" => 32, "null" => true])
            ->create();
    }
}
