<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010191617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actions (id VARCHAR(36) NOT NULL,description TEXT NOT NULL,created_at DATE NOT NULL,next_occurrence DATE,recurrence TEXT NOT NULL,title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');

        $this->addSql('CREATE TABLE domain_events (id CHAR(36) NOT NULL,aggregate_id CHAR(36) NOT NULL,name VARCHAR(255) NOT NULL,body JSON NOT NULL,occurred_on timestamp NOT NULL,PRIMARY KEY (id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE actions');
        $this->addSql('DROP TABLE domain_events');
    }
}
