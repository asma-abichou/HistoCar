<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029175215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car CHANGE user_id user_id INT DEFAULT NULL, CHANGE make make VARCHAR(60) NOT NULL, CHANGE model model VARCHAR(50) NOT NULL, CHANGE year year VARCHAR(255) NOT NULL, CHANGE mile_age mile_age INT NOT NULL, CHANGE last_service_date last_service_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car CHANGE user_id user_id INT NOT NULL, CHANGE make make VARCHAR(60) DEFAULT NULL, CHANGE model model VARCHAR(50) DEFAULT NULL, CHANGE year year VARCHAR(255) DEFAULT NULL, CHANGE mile_age mile_age INT DEFAULT NULL, CHANGE last_service_date last_service_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
