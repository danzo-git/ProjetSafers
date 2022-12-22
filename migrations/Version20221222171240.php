<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222171240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DDA545015');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, surface INT NOT NULL, status TINYINT(1) NOT NULL, ville VARCHAR(255) NOT NULL, postal VARCHAR(255) NOT NULL, INDEX IDX_45EDC386BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('DROP TABLE biens');
        $this->addSql('DROP TABLE category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386BCF5E72D');
        $this->addSql('CREATE TABLE biens (id INT AUTO_INCREMENT NOT NULL, id_category_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, surface INT NOT NULL, status TINYINT(1) NOT NULL, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, postal VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_1F9004DDA545015 (id_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DDA545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE categorie');
    }
}
