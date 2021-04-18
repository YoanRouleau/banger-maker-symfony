<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418151707 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, super_categorie_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, decription VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_497DD63498EB5807 ON categorie (super_categorie_id)');
        $this->addSql('CREATE TABLE instrument (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, custom_id INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE note (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, riff_id INTEGER NOT NULL, author_id INTEGER NOT NULL, note INTEGER NOT NULL, commentaire VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14585F76FE ON note (riff_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14F675F31B ON note (author_id)');
        $this->addSql('CREATE TABLE riff (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, instrument_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, decription VARCHAR(255) NOT NULL, customsongfile CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_30024FE8F675F31B ON riff (author_id)');
        $this->addSql('CREATE INDEX IDX_30024FE8CF11D9C ON riff (instrument_id)');
        $this->addSql('CREATE INDEX IDX_30024FE8BCF5E72D ON riff (categorie_id)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE riff');
        $this->addSql('DROP TABLE "user"');
    }
}
