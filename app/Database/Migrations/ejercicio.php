<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateEjercicios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'rutina_id'    => ['type' => 'INT', 'unsigned' => true],
            'nombre'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'series'       => ['type' => 'INT', 'unsigned' => true],
            'repeticiones' => ['type' => 'INT', 'unsigned' => true],
            'descanso'     => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        // Definición de la clave foránea vinculada a la tabla rutinas
        $this->forge->addForeignKey('rutina_id', 'rutinas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ejercicios');
    }

    public function down()
    {
        $this->forge->dropTable('ejercicios');
    }
}
