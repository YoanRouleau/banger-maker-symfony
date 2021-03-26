<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325060825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_497DD63498EB5807');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categorie AS SELECT id, super_categorie_id, name, decription, picture FROM categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, super_categorie_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, decription VARCHAR(255) DEFAULT NULL COLLATE BINARY, picture VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_497DD63498EB5807 FOREIGN KEY (super_categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO categorie (id, super_categorie_id, name, decription, picture) SELECT id, super_categorie_id, name, decription, picture FROM __temp__categorie');
        $this->addSql('DROP TABLE __temp__categorie');
        $this->addSql('CREATE INDEX IDX_497DD63498EB5807 ON categorie (super_categorie_id)');
        $this->addSql('DROP INDEX IDX_CFBDFA14585F76FE');
        $this->addSql('DROP INDEX IDX_CFBDFA14F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__note AS SELECT id, riff_id, author_id, note, commentaire FROM note');
        $this->addSql('DROP TABLE note');
        $this->addSql('CREATE TABLE note (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, riff_id INTEGER NOT NULL, author_id INTEGER NOT NULL, note INTEGER NOT NULL, commentaire VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_CFBDFA14585F76FE FOREIGN KEY (riff_id) REFERENCES riff (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CFBDFA14F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO note (id, riff_id, author_id, note, commentaire) SELECT id, riff_id, author_id, note, commentaire FROM __temp__note');
        $this->addSql('DROP TABLE __temp__note');
        $this->addSql('CREATE INDEX IDX_CFBDFA14585F76FE ON note (riff_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14F675F31B ON note (author_id)');
        $this->addSql('DROP INDEX IDX_30024FE8F675F31B');
        $this->addSql('DROP INDEX IDX_30024FE8CF11D9C');
        $this->addSql('DROP INDEX IDX_30024FE8BCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__riff AS SELECT id, author_id, instrument_id, categorie_id, name, decription, customsongfile FROM riff');
        $this->addSql('DROP TABLE riff');
        $this->addSql('CREATE TABLE riff (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, instrument_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, decription VARCHAR(255) NOT NULL COLLATE BINARY, customsongfile CLOB NOT NULL, CONSTRAINT FK_30024FE8F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_30024FE8CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_30024FE8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO riff (id, author_id, instrument_id, categorie_id, name, decription, customsongfile) SELECT id, author_id, instrument_id, categorie_id, name, decription, customsongfile FROM __temp__riff');
        $this->addSql('DROP TABLE __temp__riff');
        $this->addSql('CREATE INDEX IDX_30024FE8F675F31B ON riff (author_id)');
        $this->addSql('CREATE INDEX IDX_30024FE8CF11D9C ON riff (instrument_id)');
        $this->addSql('CREATE INDEX IDX_30024FE8BCF5E72D ON riff (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_497DD63498EB5807');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categorie AS SELECT id, super_categorie_id, name, decription, picture FROM categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, super_categorie_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, decription VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO categorie (id, super_categorie_id, name, decription, picture) SELECT id, super_categorie_id, name, decription, picture FROM __temp__categorie');
        $this->addSql('DROP TABLE __temp__categorie');
        $this->addSql('CREATE INDEX IDX_497DD63498EB5807 ON categorie (super_categorie_id)');
        $this->addSql('DROP INDEX IDX_CFBDFA14585F76FE');
        $this->addSql('DROP INDEX IDX_CFBDFA14F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__note AS SELECT id, riff_id, author_id, note, commentaire FROM note');
        $this->addSql('DROP TABLE note');
        $this->addSql('CREATE TABLE note (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, riff_id INTEGER NOT NULL, author_id INTEGER NOT NULL, note INTEGER NOT NULL, commentaire VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO note (id, riff_id, author_id, note, commentaire) SELECT id, riff_id, author_id, note, commentaire FROM __temp__note');
        $this->addSql('DROP TABLE __temp__note');
        $this->addSql('CREATE INDEX IDX_CFBDFA14585F76FE ON note (riff_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14F675F31B ON note (author_id)');
        $this->addSql('DROP INDEX IDX_30024FE8F675F31B');
        $this->addSql('DROP INDEX IDX_30024FE8CF11D9C');
        $this->addSql('DROP INDEX IDX_30024FE8BCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__riff AS SELECT id, author_id, instrument_id, categorie_id, name, decription, customsongfile FROM riff');
        $this->addSql('DROP TABLE riff');
        $this->addSql('CREATE TABLE riff (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, instrument_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, decription VARCHAR(255) NOT NULL, customsongfile CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO riff (id, author_id, instrument_id, categorie_id, name, decription, customsongfile) SELECT id, author_id, instrument_id, categorie_id, name, decription, customsongfile FROM __temp__riff');
        $this->addSql('DROP TABLE __temp__riff');
        $this->addSql('CREATE INDEX IDX_30024FE8F675F31B ON riff (author_id)');
        $this->addSql('CREATE INDEX IDX_30024FE8CF11D9C ON riff (instrument_id)');
        $this->addSql('CREATE INDEX IDX_30024FE8BCF5E72D ON riff (categorie_id)');
    }
}
