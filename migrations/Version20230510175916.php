<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510175916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD zipcode VARCHAR(255) NOT NULL, ADD latitude VARCHAR(255) NOT NULL, ADD longitude VARCHAR(255) NOT NULL, ADD is_validated TINYINT(1) NOT NULL, ADD is_bloqued TINYINT(1) NOT NULL, ADD street_name VARCHAR(255) NOT NULL, ADD street_number VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP email, DROP city, DROP zipcode, DROP latitude, DROP longitude, DROP is_validated, DROP is_bloqued, DROP street_name, DROP street_number, DROP phone, DROP firstname, DROP lastname');
    }
}
