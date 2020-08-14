<?php
class Migration_admin_signup extends CI_Migration
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
              'name' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '225',
                 'null' => true,
              ),
              'adharno' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '225',
                 'null' => true,
              ),
              'mobileno' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
              ),
              'yourid' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => true,
              ),
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user');
    }
    //down
    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}