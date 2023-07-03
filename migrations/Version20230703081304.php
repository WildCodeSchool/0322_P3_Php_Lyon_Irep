<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703081304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, exhibition_id INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_7E8585C82A7D4494 (exhibition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C82A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C82A7D4494');
        $this->addSql('DROP TABLE newsletter');
    }
}
