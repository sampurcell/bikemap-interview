<?php


use Phinx\Migration\AbstractMigration;

class UsersMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // create the table
        $table = $this->table('users', [
            'signed' => false,
        ]);
        $table
            ->addColumn('email', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('password', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 60,
            ])
            ->addColumn('first_name', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('last_name', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('birthday', 'timestamp', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('rides', 'integer', [
                'signed' => false,
                'default' => 0,
            ])
            ->addTimestamps()
            ->addIndex('email', [
                'unique' => true,
            ])
            ->create();
    }
}
