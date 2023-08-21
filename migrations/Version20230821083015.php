<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821083015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__filiere AS SELECT id, title, description, cycle FROM filiere');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('CREATE TABLE filiere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, cycle INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO filiere (id, title, description, cycle) SELECT id, title, description, cycle FROM __temp__filiere');
        $this->addSql('DROP TABLE __temp__filiere');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__filiere AS SELECT id, title, description, cycle FROM filiere');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('CREATE TABLE filiere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, cycle INTEGER NOT NULL)');
        $this->addSql('INSERT INTO filiere (id, title, description, cycle) SELECT id, title, description, cycle FROM __temp__filiere');
        $this->addSql('DROP TABLE __temp__filiere');
    }
}
