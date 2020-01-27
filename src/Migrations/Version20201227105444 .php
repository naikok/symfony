<?php
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201227105444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Script for database creation after installing all symfony dependencies';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE product (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255) default NULL, price float default NULL, barcode varchar(255) default NULL, PRIMARY KEY (id))');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP DATABASE symfony_db');
        $this->addSql('DROP TABLE product');
    }
}