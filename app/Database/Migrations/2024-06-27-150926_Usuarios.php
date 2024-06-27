<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                'type' => 'INT',
                'auto_increment' => true,
                'unique' => true
            ],
            "nome" => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            "email" => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true
            ],
            "senha" => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            "primeiroLogin" => [
                'type' => 'timestamp',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            "ultimoLogin" => [
                'type' => 'timestamp'
            ],
        ]);


        //Cria a chave primária (PK) da tabela
        $this->forge->addPrimaryKey('id');


        //Cria a tabela
        $this->forge->createTable('usuarios',true, ['engine' => 'innodb']);
    }

    public function down()
    {
        //Apaga a tabela (DROP)
        $this->forge->dropTable('usuarios');
    }
}
