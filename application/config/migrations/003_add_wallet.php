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
              'uid' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '225',
                 'null' => true,
              ),
              'money' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '225',
                 'null' => false,
                 'default' => 100,
              ),
              'total_transfer_money' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => true,
              ),
              'receive_token' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => true,
              ),
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('wallet');
    }
    //down
    public function down()
    {
        $this->dbforge->drop_table('wallet');
    }
}