<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626123516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_visit ADD picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page_visit ADD CONSTRAINT FK_25FF16EFEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_25FF16EFEE45BDBF ON page_visit (picture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_visit DROP FOREIGN KEY FK_25FF16EFEE45BDBF');
        $this->addSql('DROP INDEX IDX_25FF16EFEE45BDBF ON page_visit');
        $this->addSql('ALTER TABLE page_visit DROP picture_id');
    }
}
