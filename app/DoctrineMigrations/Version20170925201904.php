<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170925201904 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE project ADD position INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ALTER agency_id DROP NOT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EECDEADB2A FOREIGN KEY (agency_id) REFERENCES agency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2FB3D0EECDEADB2A ON project (agency_id)');
        $this->addSql('ALTER TABLE associate ALTER agency_id DROP NOT NULL');
        $this->addSql('ALTER TABLE associate ADD CONSTRAINT FK_CCE5D25CDEADB2A FOREIGN KEY (agency_id) REFERENCES agency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CCE5D25CDEADB2A ON associate (agency_id)');
        $this->addSql('ALTER TABLE project_image ALTER project_id DROP NOT NULL');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC1166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D6680DC1166D1F9C ON project_image (project_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE associate DROP CONSTRAINT FK_CCE5D25CDEADB2A');
        $this->addSql('DROP INDEX IDX_CCE5D25CDEADB2A');
        $this->addSql('ALTER TABLE associate ALTER agency_id SET NOT NULL');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EECDEADB2A');
        $this->addSql('DROP INDEX IDX_2FB3D0EECDEADB2A');
        $this->addSql('ALTER TABLE project DROP position');
        $this->addSql('ALTER TABLE project ALTER agency_id SET NOT NULL');
        $this->addSql('ALTER TABLE project_image DROP CONSTRAINT FK_D6680DC1166D1F9C');
        $this->addSql('DROP INDEX IDX_D6680DC1166D1F9C');
        $this->addSql('ALTER TABLE project_image ALTER project_id SET NOT NULL');
    }
}
