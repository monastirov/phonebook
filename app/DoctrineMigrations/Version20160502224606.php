<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160502224606 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE record (id INT UNSIGNED AUTO_INCREMENT NOT NULL, street_id INT UNSIGNED NOT NULL, name VARCHAR(200) NOT NULL, surname VARCHAR(200) NOT NULL, patronymic VARCHAR(200) NOT NULL, birth_datetime DATETIME NOT NULL, phone_number VARCHAR(15) NOT NULL, INDEX IDX_9B349F9187CF8EB (street_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9187CF8EB FOREIGN KEY (street_id) REFERENCES street (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE record');
    }
}
