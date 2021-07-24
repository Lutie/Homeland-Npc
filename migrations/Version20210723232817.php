<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723232817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attributes (id INT AUTO_INCREMENT NOT NULL, isPrimary TINYINT(1) DEFAULT \'0\' NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, create_at DATE NOT NULL, sex VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_attribute (character_id INT NOT NULL, attribute_id INT NOT NULL, INDEX IDX_7D2A4DC01136BE75 (character_id), INDEX IDX_7D2A4DC0B6E62EFA (attribute_id), PRIMARY KEY(character_id, attribute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_particularity (character_id INT NOT NULL, particularity_id INT NOT NULL, INDEX IDX_44007AED1136BE75 (character_id), INDEX IDX_44007AEDA48617FF (particularity_id), PRIMARY KEY(character_id, particularity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE particularities (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, ratio VARCHAR(255) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE particularity_attribute (particularity_id INT NOT NULL, attribute_id INT NOT NULL, INDEX IDX_55340EE6A48617FF (particularity_id), INDEX IDX_55340EE6B6E62EFA (attribute_id), PRIMARY KEY(particularity_id, attribute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_attribute ADD CONSTRAINT FK_7D2A4DC01136BE75 FOREIGN KEY (character_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_attribute ADD CONSTRAINT FK_7D2A4DC0B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attributes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_particularity ADD CONSTRAINT FK_44007AED1136BE75 FOREIGN KEY (character_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_particularity ADD CONSTRAINT FK_44007AEDA48617FF FOREIGN KEY (particularity_id) REFERENCES particularities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE particularity_attribute ADD CONSTRAINT FK_55340EE6A48617FF FOREIGN KEY (particularity_id) REFERENCES particularities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE particularity_attribute ADD CONSTRAINT FK_55340EE6B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attributes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_attribute DROP FOREIGN KEY FK_7D2A4DC0B6E62EFA');
        $this->addSql('ALTER TABLE particularity_attribute DROP FOREIGN KEY FK_55340EE6B6E62EFA');
        $this->addSql('ALTER TABLE character_attribute DROP FOREIGN KEY FK_7D2A4DC01136BE75');
        $this->addSql('ALTER TABLE character_particularity DROP FOREIGN KEY FK_44007AED1136BE75');
        $this->addSql('ALTER TABLE character_particularity DROP FOREIGN KEY FK_44007AEDA48617FF');
        $this->addSql('ALTER TABLE particularity_attribute DROP FOREIGN KEY FK_55340EE6A48617FF');
        $this->addSql('DROP TABLE attributes');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE character_attribute');
        $this->addSql('DROP TABLE character_particularity');
        $this->addSql('DROP TABLE particularities');
        $this->addSql('DROP TABLE particularity_attribute');
    }
}
