<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170204091404 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, genre_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, year INT NOT NULL, INDEX IDX_CBE5A331F675F31B (author_id), INDEX IDX_CBE5A3314296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstName VARCHAR(100) DEFAULT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, confirmationToken VARCHAR(255) DEFAULT NULL, passwordRequestedAt DATETIME DEFAULT NULL, createdAt DATETIME NOT NULL, lastLoginAt DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_835033F8989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, firstName VARCHAR(100) NOT NULL, lastName VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3314296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3314296D31F');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE author');
    }
}
