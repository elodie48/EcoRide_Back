<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251123000705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carsharing (id INT AUTO_INCREMENT NOT NULL, departure_date DATE NOT NULL, departure_hour TIME NOT NULL, departure_place VARCHAR(255) NOT NULL, arrival_date DATE NOT NULL, arrival_hour TIME NOT NULL, arrival_place VARCHAR(255) NOT NULL, nb_of_places_available SMALLINT NOT NULL, price_per_person SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE carsharing');
    }
}
