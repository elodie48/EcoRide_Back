<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251123162231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carsharing ADD car_id INT NOT NULL');
        $this->addSql('ALTER TABLE carsharing ADD CONSTRAINT FK_4FDAE719C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_4FDAE719C3C6F69F ON carsharing (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carsharing DROP FOREIGN KEY FK_4FDAE719C3C6F69F');
        $this->addSql('DROP INDEX IDX_4FDAE719C3C6F69F ON carsharing');
        $this->addSql('ALTER TABLE carsharing DROP car_id');
    }
}
