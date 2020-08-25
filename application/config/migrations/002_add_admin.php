<?php
class Migration_Add_Admin extends CI_Migration
{
  //create
    public function up(){
        $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => true,
                 'auto_increment' => true
              ),
              'email' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '225',
                 'null' => true,
              ),
              'password' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '225',
                 'null' => true,
              ),
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('admin');
    }
    //down
    public function down()
    {
        $this->dbforge->drop_table('admin');
    }
}