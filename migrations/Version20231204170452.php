<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204170452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE auth_users (id VARCHAR(36) NOT NULL,first_name VARCHAR(255) NOT NULL,last_name VARCHAR(255) NOT NULL,email VARCHAR(255) NOT NULL,password VARCHAR(255) NOT NULL,created_at DATE NOT NULL,updated_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE auth_tokens (id VARCHAR(36) NOT NULL,auth_user_id VARCHAR(36) NOT NULL,token VARCHAR(255) NOT NULL,created_at DATE NOT NULL,expires_at DATE NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE auth_users');
        $this->addSql('DROP TABLE auth_tokens');
    }
}
