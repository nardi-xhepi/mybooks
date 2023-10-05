<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005180603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__livre AS SELECT id, description, auteur, titre FROM livre');
        $this->addSql('DROP TABLE livre');
        $this->addSql('CREATE TABLE livre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, librairie_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, CONSTRAINT FK_AC634F99330C7BB3 FOREIGN KEY (librairie_id) REFERENCES librairie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO livre (id, description, auteur, titre) SELECT id, description, auteur, titre FROM __temp__livre');
        $this->addSql('DROP TABLE __temp__livre');
        $this->addSql('CREATE INDEX IDX_AC634F99330C7BB3 ON livre (librairie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__livre AS SELECT id, description, auteur, titre FROM livre');
        $this->addSql('DROP TABLE livre');
        $this->addSql('CREATE TABLE livre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO livre (id, description, auteur, titre) SELECT id, description, auteur, titre FROM __temp__livre');
        $this->addSql('DROP TABLE __temp__livre');
    }
}
