<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170909103904 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE agency ADD address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE agency ALTER phone TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agency ALTER phone DROP DEFAULT');
        $this->addSql('ALTER TABLE agency ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE agency ALTER email DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE agency DROP address');
        $this->addSql('ALTER TABLE agency ALTER phone TYPE TEXT');
        $this->addSql('ALTER TABLE agency ALTER phone DROP DEFAULT');
        $this->addSql('ALTER TABLE agency ALTER email TYPE TEXT');
        $this->addSql('ALTER TABLE agency ALTER email DROP DEFAULT');
    }
}
