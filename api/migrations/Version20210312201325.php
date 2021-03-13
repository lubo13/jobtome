<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312201325 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE redirection_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE url_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE redirection (id INT NOT NULL, url_id INT DEFAULT NULL, counter INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_224450F781CFDAE7 ON redirection (url_id)');
        $this->addSql('CREATE TABLE url (id INT NOT NULL, origin VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE redirection ADD CONSTRAINT FK_224450F781CFDAE7 FOREIGN KEY (url_id) REFERENCES url (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE redirection DROP CONSTRAINT FK_224450F781CFDAE7');
        $this->addSql('DROP SEQUENCE redirection_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE url_id_seq CASCADE');
        $this->addSql('DROP TABLE redirection');
        $this->addSql('DROP TABLE url');
    }
}
