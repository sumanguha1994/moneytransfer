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
              'sid' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '225',
                 'null' => true,
              ),
              'rname' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '225',
                 'null' => true,
              ),
              'rmobile' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => true,
              ),
              'ramount' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => true,
              ),
              'rtoken' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => true,
              ),
              'created_date datetime default current_timestamp',
              'updated_date datetime default current_timestamp on update current_timestamp',
           )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('payment');
    }
    //down
    public function down()
    {
        $this->dbforge->drop_table('payment');
    }
}