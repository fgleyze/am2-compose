<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180107101024 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE project DROP imagename');
        $this->addSql('ALTER TABLE project_image ADD width INT NOT NULL');
        $this->addSql('ALTER TABLE project_image ADD height INT NOT NULL');
        $this->addSql('ALTER TABLE project_image ADD thumb_width INT NOT NULL');
        $this->addSql('ALTER TABLE project_image ADD thumb_height INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project ADD imagename VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project_image DROP width');
        $this->addSql('ALTER TABLE project_image DROP height');
        $this->addSql('ALTER TABLE project_image DROP thumb_width');
        $this->addSql('ALTER TABLE project_image DROP thumb_height');
    }
}
