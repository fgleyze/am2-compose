<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170909153228 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, features TEXT DEFAULT NULL, imageName VARCHAR(255) DEFAULT NULL, updatedAt TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, agency_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE agency ALTER name DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP TABLE project');
        $this->addSql('ALTER TABLE agency ALTER name SET DEFAULT \'foo\'');
    }
}
